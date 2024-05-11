# ElectricaBillHub

ElectricaBillHub is a web application that aims to facilitate the management of the yearly and monthly electrical consumption of customers, and also their complaints.

## Used technologies:

This web application is made using the following technologies:

- **PHP** (as a backend technology for the management of the server side)
- **Bootstrap** (the styling framework frequently used for managing the style of the application)
- **MySQL** (for relational database management)

## Main functionalities:

### Customer Space:

- Every month, the customer should submit the month's consumption and also upload a photo of the electric meter.
- Check the electricity bills of each month.
- Submit a complaint after choosing its type:
  
  - Internal leak
  - External leak
  - Bill
  - Other (specify)

### Supplier Space:

- Management of customers (adding new customers, editing their information).
- Processing customer complaints and notifying them via sending a response.
- Handling anomalies in customer consumption submissions:
  
  - If any anomaly is detected, the bill is automatically generated in PDF format, containing all details of the customer's information, the value of consumption, excluding tax and including tax prices, and the electric meter photo.
  - Otherwise, the supplier should adjust the consumption value for a specific month before generating the electrical bill.

- At the end of each year, the supplier should upload the annual consumption `.txt` file of customers, provided by the agent, to check if the difference between the agent's and customer's consumption is less than or equal to 50 KWH.

  - If yes, it will be considered tolerated.
  - If not, it won't be accepted.

### Additional details:

- **VAT** = 14%
- Unit price per month depending on consumption:

  - Between 0 and 100 KWH -> 0.8 DH/KWH
  - Between 101 and 200 KWH -> 0.9 DH/KWH
  - More than 201 KWH -> 1.0 DH/KWH

## Credits:

This project was made by Khadija EL MADANI and is an academic project.
