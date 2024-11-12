pipeline {
    agent any // Se utiliza cualquier agente/nodo disponible en Jenkins para ejecutar la pipeline

    stages { // Define todas las etapas de la pipeline
        stage('Checkout Code') { // Etapa para clonar el repositorio de GitHub
            steps {
                git branch: 'main', url: 'https://github.com/EdgarAGonz/ci-pipeline-demo'
            }
        }

        stage('Install PHP Dependencies') { // Instala dependencias para PHP
            steps {
                dir('php') { // Cambia al directorio de PHP
                    sh 'composer install' // Instala dependencias con Composer
                    sh 'composer dump-autoload' // Actualiza el autoload de Composer
                }
            }
        }

        stage('Run PHP Unit Tests') { // Ejecuta pruebas unitarias en el código PHP
            steps {
                dir('php') {
                    sh 'chmod +x vendor/bin/phpunit' // Otorga permisos de ejecución a PHPUnit
                    sh 'vendor/bin/phpunit --coverage-text --coverage-clover=coverage.xml' // Ejecuta PHPUnit con cobertura
                }
            }
        }

        stage('Run PHP CodeSniffer') { // Revisa el código PHP para verificar el estándar de codificación
            steps {
                dir('php') {
                    sh 'chmod +x vendor/bin/phpcs' // Otorga permisos de ejecución a PHP CodeSniffer
                    sh 'vendor/bin/phpcs --standard=PSR12 src/' // Verifica el estándar PSR12 en el código fuente
                }
            }
        }

        stage('Install Python Dependencies') { // Instala dependencias para Python
            steps {
                dir('python') {
                    sh 'python3 -m venv venv' // Crea un entorno virtual en el directorio 'venv'
                    sh '. venv/bin/activate && pip install -r requirements.txt' // Activa el entorno virtual e instala dependencias
                }
            }
        }

        stage('Run Python Tests') { // Ejecuta pruebas en el código Python
            steps {
                dir('python') {
                    sh '. venv/bin/activate && pytest --junitxml=python-test-results.xml' // Ejecuta Pytest y genera un reporte en XML
                }
            }
        }

        stage('Install JavaScript Dependencies') { // Instala dependencias para JavaScript
            steps {
                dir('javascript') {
                    sh 'npm install' // Instala dependencias de npm
                }
            }
        }

        stage('Run JavaScript Tests') { // Ejecuta pruebas en el código JavaScript
            steps {
                dir('javascript') {
                    sh 'npm test' // Ejecuta pruebas con npm (suponiendo que usa Jest o similar)
                }
            }
        }

        stage('Generate PHP Documentation') { // Genera documentación del código PHP
            steps {
                dir('php') {
                    sh 'chmod +x vendor/bin/phpdoc' // Otorga permisos de ejecución a phpDocumentor
                    sh './vendor/bin/phpdoc -c phpdoc.xml' // Genera la documentación con la configuración especificada
                }
            }
        }

        stage('Generate JavaScript Documentation') { // Genera documentación del código JavaScript
            steps {
                dir('javascript') {
                    sh 'chmod +x node_modules/.bin/jsdoc' // Otorga permisos de ejecución a JSDoc
                    sh './node_modules/.bin/jsdoc -c jsdoc.json' // Genera la documentación con la configuración de JSDoc
                }
            }
        }

        stage('Generate Python Documentation') { // Genera documentación para el código Python
            steps {
                dir('python/docs') {
                    sh '. ../venv/bin/activate && sphinx-build -b html . ../../build/docs/python' // Usa Sphinx para generar documentación HTML
                }
            }
        }
    }

    post { // Post-acciones que se ejecutan después de todas las etapas de la pipeline
        always {
            // Archiva los archivos generados para referencia futura
            archiveArtifacts artifacts: '**/coverage.xml', allowEmptyArchive: true // Archiva el reporte de cobertura de pruebas PHP
            archiveArtifacts artifacts: 'build/docs/**', allowEmptyArchive: true // Archiva toda la documentación generada
            archiveArtifacts artifacts: '**/python-test-results.xml', allowEmptyArchive: true // Archiva los resultados de pruebas Python
        }
    }
}
