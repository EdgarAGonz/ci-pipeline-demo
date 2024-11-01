pipeline {
    agent any

    stages {
        stage('Checkout Code') {
            steps {
                git branch: 'main', url: 'https://github.com/EdgarAGonz/ci-pipeline-demo'
            }
        }

        stage('Install PHP Dependencies') {
            steps {
                dir('php') {
                    sh 'composer install'
                    sh 'composer dump-autoload'
                }
            }
        }

        stage('Run PHP Unit Tests') {
            steps {
                dir('php') {
                    sh 'chmod +x vendor/bin/phpunit'
                    sh 'vendor/bin/phpunit --coverage-text --coverage-clover=coverage.xml'
                }
            }
        }

        stage('Run PHP CodeSniffer') {
            steps {
                dir('php') {
                    sh 'chmod +x vendor/bin/phpcs'
                    sh 'vendor/bin/phpcs --standard=PSR12 src/'
                }
            }
        }

        stage('Install Python Dependencies') {
            steps {
                dir('python') {
                    sh 'python3 -m venv venv'
                    sh '. venv/bin/activate && pip install -r requirements.txt'
                }
            }
        }

        stage('Run Python Tests') {
            steps {
                dir('python') {
                    sh '. venv/bin/activate && pytest --junitxml=python-test-results.xml'
                }
            }
        }

        stage('Install JavaScript Dependencies') {
            steps {
                dir('javascript') {
                    sh 'npm install'
                }
            }
        }

        stage('Run JavaScript Tests') {
            steps {
                dir('javascript') {
                    sh 'npm test'
                }
            }
        }

        stage('Generate PHP Documentation') {
            steps {
                dir('php') {
                    sh 'mkdir -p ../build/docs/php'
                    sh 'chmod +x vendor/bin/phpdoc'
                    sh './vendor/bin/phpdoc -c phpdoc.xml'
                }
            }
        }

        stage('Generate JavaScript Documentation') {
            steps {
                dir('javascript') {
                    sh 'mkdir -p ../build/docs/js'
                    sh 'chmod +x node_modules/.bin/jsdoc'
                    sh './node_modules/.bin/jsdoc -c jsdoc.json'
                }
            }
        }

        stage('Generate Python Documentation') {
            steps {
                dir('python/docs') {
                    sh '. ../venv/bin/activate && sphinx-build -b html . ../../build/docs/python'
                }
            }
        }
    }

    post {
        always {
            // Asegura permisos en el directorio de documentación para evitar problemas de copia
            sh 'chmod -R 755 build/docs/'

            // Archivar los archivos de cobertura y resultados de prueba
            archiveArtifacts artifacts: '**/coverage.xml', allowEmptyArchive: true
            archiveArtifacts artifacts: 'build/docs/**', allowEmptyArchive: true
            archiveArtifacts artifacts: '**/python-test-results.xml', allowEmptyArchive: true

            // Publicar la documentación de PHP
            publishHTML(target: [
                reportName: 'PHP Documentation',
                reportDir: 'build/docs/php',
                reportFiles: 'index.html',
                alwaysLinkToLastBuild: true,
                keepAll: true
            ])

            // Publicar la documentación de JavaScript
            publishHTML(target: [
                reportName: 'JavaScript Documentation',
                reportDir: 'build/docs/js',
                reportFiles: 'index.html',
                alwaysLinkToLastBuild: true,
                keepAll: true
            ])

            // Publicar la documentación de Python
            publishHTML(target: [
                reportName: 'Python Documentation',
                reportDir: 'build/docs/python',
                reportFiles: 'index.html',
                alwaysLinkToLastBuild: true,
                keepAll: true
            ])
        }
    }
}