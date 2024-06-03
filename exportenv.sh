#!/bin/bash
ENV_FILE=.env

# Read .env file and format environment variables for gcloud
VARS=$(grep -v '^#' $ENV_FILE | xargs -I {} echo -n '{}',)

# Remove the trailing comma
VARS=${VARS%,}

# Update Cloud Run service with environment variables
gcloud run services update cassinobles --set-env-vars "$VARS"
