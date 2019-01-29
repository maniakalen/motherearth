#!/usr/bin/env bash
function info {
  echo " "
  echo "--> $1"
  echo " "
}

info "Runs liquibase update from composer"

cd /app && composer liquibase-update