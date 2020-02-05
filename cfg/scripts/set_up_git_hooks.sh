#!/usr/bin/env bash

PRE_PUSH_FILE='pre-push'
HOOKS="${PWD}/.git/hooks/"
if [ ! -f ${HOOKS}${PRE_PUSH_FILE} ]; then
  echo "Linkeando pre-push"
  ln -s ${PRE_PUSH_FILE} ${HOOKS}${PRE_PUSH_FILE}
fi