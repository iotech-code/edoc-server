FROM node:8
# USER 1000

WORKDIR /home/node/app

RUN npm install  && \
    npm install sequelize -g && \
    npm install nodemon -g

EXPOSE 3000

CMD ["nodemon", "./bin/www"]