const express = require('express');
const bodyParser = require('body-parser');
const nodemailer = require('nodemailer');

const app = express();
const PORT = process.env.PORT || 3000;

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

app.post('/send-email', (req, res) => {
    const { name, email, destination, departureDate, returnDate, travelers } = req.body;

    const transporter = nodemailer.createTransport({
        service: 'gmail',
        auth: {
            user: 'ondakocollins@gmail.com',
            pass: '@Cacti_Tracy'
        }
    });

    const mailOptions = {
        from: 'ondakocollins@gmail.com',
        to: email,
        subject: 'Booking Confirmation',
        text: `Hello ${name},\n\nThank you for booking your trip with us. Here are your booking details:\n\nDestination: ${destination}\nDeparture Date: ${departureDate}\nReturn Date: ${returnDate}\nNumber of Travelers: ${travelers}\n\nWe hope you have a great trip!\n\nBest regards,\nYour Travel Agency`
    };

    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            console.log(error);
            res.status(500).send('Error sending email');
        } else {
            console.log('Email sent: ' + info.response);
            res.status(200).send('Email sent');
        }
    });
});

app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
