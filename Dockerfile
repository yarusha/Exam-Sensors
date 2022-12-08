FROM php

WORKDIR /sensor-app

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]


