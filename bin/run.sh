#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

${PHP_EXECUTABLE_PATH} -S localhost:8999 -t ${DIR}/../web/