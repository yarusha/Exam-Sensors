FROM php

WORKDIR /sensor-app

COPY ./sensor-app /sensor-app

CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]


