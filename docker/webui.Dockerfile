FROM node:lts-alpine3.18

WORKDIR /usr/src/app/webui
COPY webui/package*.json ./

RUN ls -la

RUN npm install

CMD ["npm", "run", "serve"]
