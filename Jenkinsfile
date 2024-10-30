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
                }
            }
        }

        stage('Run PHP Unit Tests') {
            steps {
                dir('php') {
                    // Otorga permisos de ejecución al archivo phpunit
                    sh 'chmod +x vendor/bin/phpunit'
                    // Ejecuta las pruebas
                    sh 'vendor/bin/phpunit --coverage-text --coverage-clover=coverage.xml'
                }
            }
        }

        stage('Run PHP CodeSniffer') {
            steps {
                dir('php') {
                    // Otorga permisos de ejecución al archivo phpcs
                    sh 'chmod +x vendor/bin/phpcs'
                    // Ejecuta PHP CodeSniffer con el estándar PSR12
                    sh 'vendor/bin/phpcs --standard=PSR12 src/'
                }
            }
        }

        stage('Install Python Dependencies') {
            steps {
                dir('python') {
                    sh 'pip install -r requirements.txt'
                }
            }
        }

        stage('Run Python Tests') {
            steps {
                dir('python') {
                    sh 'pytest --junitxml=python-test-results.xml'
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
                    // Otorga permisos de ejecución a phpdoc
                    sh 'chmod +x vendor/bin/phpdoc'
                    sh './vendor/bin/phpdoc -c phpdoc.xml'
                }
            }
        }

        stage('Generate JavaScript Documentation') {
            steps {
                dir('javascript') {
                    sh 'jsdoc -c jsdoc.json'
                }
            }
        }

        stage('Generate Python Documentation') {
            steps {
                dir('python/docs') {
                    sh 'sphinx-build -b html . ../../build/docs/python'
                }
            }
        }
    }

    post {
        always {
            archiveArtifacts artifacts: '**/coverage.xml', allowEmptyArchive: true
            archiveArtifacts artifacts: 'build/docs/**', allowEmptyArchive: true
            archiveArtifacts artifacts: '**/python-test-results.xml', allowEmptyArchive: true
        }
    }
}