
# Price Checker for Retail Stores

## Overview
Price Checker is a PHP application designed to compare product prices between two retail stores based on Excel files exported from a CRM, ERP, or sales system. It allows users to identify price differences easily and determine which store offers higher prices on specific products. The application is ideal for shoppers looking to get the best deals and businesses monitoring competitor pricing.

## Features
- **Price Comparison:** Compares products and prices between two stores.
- **Custom Pricing:** Users can customize how prices are compared based on their preferences.
- **Product Listing:** Lists products and their price differences clearly.
- **Highest Price Indicator:** Identifies which store has the higher price for each product.
- **Excel Export:** Allows exporting the list of products with their price differences to Excel.

## Technology
- PHP: The application is built using PHP, ensuring a lightweight and server-side approach.
- No Database Needed: It runs without a database, making it simple and efficient.
-  Login System: Features a simple login system based on a constant array for authentication.
- Composer: Utilizes Composer for managing dependencies.
- PHPOffice with PHPSpreadsheet: Integrates PHPOffice's PHPSpreadsheet for handling Excel file operations.

## Setup and Installation
1. Clone the Repository:
   ```bash
   git clone https://github.com/hectorguedea/price-checker-stores.git
2. Install Dependencies:
    ```bash
   composer install
3. Configuration
- Configure the product comparison settings in the `include/upload.php` file, based on the pattern of columns of your exported Excel files (`$cells)`.
- Set up the login credentials in the `include/sistema.class.php` file on at¡rray constant `USER_DATA` 

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Author

[Héctor Guedea](https://hectorguedea.com/)

## License

[MIT](https://choosealicense.com/licenses/mit/)