FROM node:12-alpine

RUN npm i -g maildev

EXPOSE 1080 1025
CMD ["maildev", "--incoming-user", "smtp_user", "--incoming-pass", "smtp_password"]
