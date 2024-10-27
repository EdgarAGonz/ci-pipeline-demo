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
                sh 'composer install'
            }
        }

        stage('Run PHP Unit Tests') {
            steps {
                sh 'vendor/bin/phpunit --coverage-text --coverage-clover=coverage.xml'
            }
        }

        stage('Run PHP CodeSniffer') {
            steps {
                sh 'vendor/bin/phpcs --standard=PSR12 src/'
            }
        }

        stage('Install Python Dependencies') {
            steps {
                sh 'pip install -r python/requirements.txt'
                sh 'pip install sphinx'
            }
        }

        stage('Run Python Tests') {
            steps {
                sh 'python -m unittest discover python'
            }
        }

        stage('Generate Documentation') {
            steps {
                sh 'sphinx-build -b html python/docs build/docs'
            }
        }
    }

    post {
        always {
            archiveArtifacts artifacts: '**/coverage.xml', allowEmptyArchive: true
            archiveArtifacts artifacts: 'build/docs/**', allowEmptyArchive: true
        }
    }
}
