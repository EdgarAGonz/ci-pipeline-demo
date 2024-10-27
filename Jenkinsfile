pipeline {
    agent any

    stages {
        stage('Checkout Code') {
            steps {
                git 'https://github.com/EdgarAGonz/ci-pipeline-demo'
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
                    sh 'vendor/bin/phpunit --coverage-text --coverage-clover=coverage.xml'
                }
            }
        }

        stage('Run PHP CodeSniffer') {
            steps {
                dir('php') {
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
