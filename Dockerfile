FROM php:7.4-cli
COPY . /Users/adnanmalik/string-calc
WORKDIR /Users/adnanmalik/string-calc
CMD [ "php", "./index.php" ]