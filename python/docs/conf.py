import os
import sys
sys.path.insert(0, os.path.abspath('../'))

project = 'Python Project Documentation'
extensions = ['sphinx.ext.autodoc']
templates_path = ['_templates']
exclude_patterns = []
html_theme = 'alabaster'