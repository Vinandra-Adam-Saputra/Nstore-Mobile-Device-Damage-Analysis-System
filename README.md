# Mobile Device Damage Analysis Website

## Project Overview

This project is a web-based application that analyzes mobile device damage using the Naive Bayes method. The system utilizes real datasets collected from a mobile phone service center (NST STORE) to provide accurate damage assessments.

## Features

### User Features (No Login Required)
1. Damage Analysis
   - Input symptoms of device damage
   - View instant analysis results including:
     - Type of damage
     - Brief description of the damage
2. Feedback System
   - Provide suggestions or feedback via a text box

### Admin Features (Login Required)
1. Data Management
   - Add, edit, and delete symptom data
   - Add, edit, and delete symptom option data
   - Add, edit, and delete damage data
2. Accuracy Monitoring
   - View accuracy metrics of the Naive Bayes model
3. Dataset Management
   - Manage and update the training dataset
4. Feedback Review
   - Access and review user suggestions and feedback

## Technical Details

### Methodology
- Naive Bayes algorithm for classification and prediction of mobile device damage

### Dataset
- Real-world data collected from a mobile phone service center
- Continuously updated to improve accuracy

### System Architecture
1. Frontend:
   - User interface for symptom input and result display
   - Admin dashboard for data management and system monitoring
2. Backend:
   - API for processing user inputs
   - Naive Bayes model implementation
   - Database management system

### Security
- Admin authentication system to protect sensitive operations and data

## Installation and Setup

To set up this project locally, follow these steps:

1. Clone the repository
2. Set up a virtual environment (recommended)
3. Install dependencies
4. Set up the database
5. Load initial data (if available)
6. Start the development server

## Usage Guide

### For Users
1. Access the website
2. Navigate to the damage analysis section
3. Input observed symptoms of your device
4. Review the analysis results
5. (Optional) Provide feedback or suggestions

### For Admins
1. Access the admin login page
2. Enter credentials to log in
3. Use the dashboard to:
   - Manage symptom and damage data
   - Monitor system accuracy
   - Review user feedback

## Contributing

We welcome contributions to improve this project. Here's how you can contribute:

1. Fork the repository
2. Create a new branch (`git checkout -b feature/AmazingFeature`)
3. Make your changes
4. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
5. Push to the branch (`git push origin feature/AmazingFeature`)
6. Open a Pull Request

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.


## Contact

Email : adamvinandra767@gmail.com

Project Link: (https://github.com/Vinandra-Adam-Saputra/Nstore-Mobile-Device-Damage-Analysis-System.git)

For any queries or suggestions, please open an issue on GitHub or contact the maintainer directly.

## Acknowledgements

- [Bootstrap](https://getbootstrap.com/) for responsive design components (if used)
- [Font Awesome](https://fontawesome.com/) for icons (if used)
- [Google Fonts](https://fonts.google.com/) for typography (if used)
- [Chart.js](https://www.chartjs.org/) for data visualization (if used)
- The mobile phone service center (NST STORE)
-
-   for providing the initial dataset
- All contributors who have helped to improve this project
