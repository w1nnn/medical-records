# Medical Records Application for Puskesmas Kododewata

## Description
This application is designed to facilitate Puskesmas Kododewata in managing patient medical records. With intuitive and efficient features, this application helps healthcare staff to record, access, and manage medical record information digitally. Users can easily search for data, update information, and manage transactions related to healthcare services.

## Features

### 1. Home Page
The home page provides an overview of the application. Here, users can find important information and navigate to other sections of the application.

- **Brief Description**: Explains the purpose of the application.
- **Navigation**: Links to the login page and further information.

![Home Page Screenshot](https://github.com/user-attachments/assets/a923eda2-3a0c-4d69-8d26-11fdbb187490)

### 2. Login Page
The login page allows users to sign in to their accounts.

- **Login Form**:
  - **Username**: Field for entering the username.
  - **Password**: Field for entering the password.
  - **Login Button**: To authenticate the user.
- **Registration Link**: Directs users to the registration page if they do not have an account.

![Login Page Screenshot](https://github.com/user-attachments/assets/538e27cd-1240-434a-822d-fae2288e858f)

### 3. Dashboard
After successfully logging in, users will be directed to their dashboard.

- **Medical Record Summary**: Displays the total medical records, patient statistics, medications, medical units, and recent transactions.
- **Navigation**: Links to the transaction page and account settings.

![Dashboard Screenshot](https://github.com/user-attachments/assets/e8232e46-4024-44b3-b6fa-86a4e5e92ce2)

### 4. Medical Card
The Medical Card serves as an integrated record that stores important information about each patient. Through the Medical Card, healthcare staff can easily access medical history, diagnoses, treatments, and previous patient visits.

![Medical Card Screenshot](https://github.com/user-attachments/assets/98034e9f-1022-4a92-9090-9fafe1f7c5aa)

### 5. Transaction Page
The transaction page allows users to view and manage transactions related to healthcare services.

- **Transaction List**: A table displaying all transactions with information such as date, description, amount, and category.
- **Add Transaction**: A form to add a new transaction.
- **Edit and Delete**: Options to edit or delete existing transactions.

![Transaction Page Screenshot](https://github.com/user-attachments/assets/21a90923-beeb-47d5-8786-c06a006459bd)

### 6. Reports
Reports provide a summary and analysis of medical record and transaction data. Users can generate reports based on specific criteria, such as time periods, types of services, and patient statistics. This helps Puskesmas Kododewata evaluate performance and plan better healthcare service strategies.

![Reports Screenshot](https://github.com/user-attachments/assets/40249223-6f87-4ccc-a630-942fccf1439e)

## Technologies Used
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Authentication**: JWT (JSON Web Tokens)
- **Payment Gateway**: Midtrans Service
- **API**: Satu Sehat
  
## Instalasi

1. Clone repositori ini:
   ```bash
   git clone https://github.com/w1nnn/medical-record.git
2. Import Database:
   ```bash
   mysql -u <username> -p <database-name> < /path/to/file.sql
3. Run Server:
 ```bash
 php -S localhost:8000


