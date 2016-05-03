FROM node:5.5

RUN npm install -g grunt-cli

RUN mkdir /npm
WORKDIR /npm
ADD package.json package.json
RUN npm install

ADD docker/grunt/run.sh /opt/run.sh

ENTRYPOINT ["/opt/run.sh"]

CMD [""]
