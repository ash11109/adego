-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 11, 2026 at 02:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srs_adego`
--

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE `career` (
  `id` int(11) NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `apply_for` varchar(100) NOT NULL,
  `resume` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `applied_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `career`
--

INSERT INTO `career` (`id`, `applicant_name`, `email`, `mobile`, `apply_for`, `resume`, `status`, `applied_at`) VALUES
(1, 'Keith Duke', 'qujasevavy@mailinator.com', '6448494894', 'Field Surveyor', '', 'applied', '2026-02-01 19:04:38'),
(2, 'Harish Kumar', 'kuruvo@mailinator.com', '9494984948', 'Sr. Asst. Manager (Team Leader)', '123.pdf', 'applied', '2026-02-01 19:06:56'),
(3, 'NPNarayan', 'npnarayan1992@gmail.com', '8789171115', 'Sr. Asst. Manager (Team Leader)', '', 'applied', '2026-02-11 16:23:21'),
(4, 'Jackson Bentley', 'napijulu@mailinator.com', '5145459454', 'Sr. Asst. Manager (Team Leader)', '', 'applied', '2026-02-11 16:24:57'),
(5, 'James Bruce', 'tajyqiq@mailinator.com', '5154564894', 'Asst. Field Manager (Statistic)', '', 'applied', '2026-02-11 16:26:27'),
(6, 'NPNarayan', 'npnarayan1992@gmail.com', '7567658756', 'Asst. Field Manager (Statistic)', '', 'applied', '2026-02-11 16:27:32'),
(7, 'Autumn Ferguson', 'simaky@mailinator.com', '7477678686', 'Asst. Field Manager (Statistic)', '', 'applied', '2026-02-11 16:31:46'),
(8, 'Martina Miller', 'mezulymaw@mailinator.com', '1851515151', 'Asst. Field Manager (Statistic)', '', 'applied', '2026-02-11 16:35:47'),
(9, 'Odette Lynch', 'fuka@mailinator.com', '6456545646', 'Asst. Field Manager (Statistic)', '', 'applied', '2026-02-11 16:40:51'),
(10, 'Brynn Porter', 'sefidagyru@mailinator.com', '5456464654', 'Asst. Field Manager (Statistic)', '', 'applied', '2026-02-11 16:42:18'),
(11, 'Alec Mcmillan', 'nimexe@mailinator.com', '1565645645', 'Asst. Field Manager (Statistic)', '', 'applied', '2026-02-11 16:47:18'),
(12, 'Cameron Mcintosh', 'nahaju@mailinator.com', '4594984949', 'Field Surveyor', '', 'applied', '2026-02-11 17:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(150) NOT NULL,
  `interest` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `trash` varchar(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `address`, `interest`, `message`, `trash`, `date`) VALUES
(1, 'npanrayan', 'sample@mail.com', '1234567890', 'Regarding Company Details', '', 'I have to know more about your company. I am interested to know more.', '1', '2025-08-22 21:43:27'),
(2, 'Rahul Sharma', 'sample@mail.com', '1234567890', 'Product Inquiry', '', 'I would like to know more about your products.', '1', '2025-08-22 10:15:22'),
(3, 'Priya Verma', 'sample@mail.com', '1234567890', 'Support Request', '', 'I am facing an issue with my recent purchase.', '0', '2025-08-22 10:20:30'),
(4, 'Amit Kumar', 'sample@mail.com', '1234567890', 'Feedback', '', 'Great experience with your services.', '0', '2025-08-22 10:25:45'),
(5, 'Sneha Gupta', 'sample@mail.com', '1234567890', 'Complaint', '', 'The delivery was delayed by 3 days.', '0', '2025-08-22 10:31:05'),
(6, 'Vikas Singh', 'sample@mail.com', '1234567890', 'Collaboration', '', 'We are interested in partnership opportunities.', '0', '2025-08-22 10:36:50'),
(7, 'Anjali Mehta', 'sample@mail.com', '1234567890', 'Request for Quotation', '', 'Please provide a quotation for bulk order.', '0', '2025-08-22 10:42:12'),
(8, 'Karan Yadav', 'sample@mail.com', '1234567890', 'Product Demo', '', 'Can I schedule a demo of your product?', '0', '2025-08-22 10:48:09'),
(9, 'Neha Joshi', 'sample@mail.com', '1234567890', 'Return Request', '', 'I would like to return my order.', '0', '2025-08-22 10:53:25'),
(10, 'Rohit Agarwal', 'sample@mail.com', '1234567890', 'Career Inquiry', '', 'Are there any job openings available?', '0', '2025-08-22 10:59:42'),
(11, 'Simran Kaur', 'sample@mail.com', '1234567890', 'General Query', '', 'Do you provide international shipping?', '0', '2025-08-22 11:05:33'),
(12, 'Manish Patel', 'sample@mail.com', '1234567890', 'Product Customization', '', 'Can I customize the product color?', '0', '2025-08-22 11:11:12'),
(13, 'Ritika Sharma', 'sample@mail.com', '1234567890', 'Billing Issue', '', 'I was charged twice for my order.', '0', '2025-08-22 11:16:28'),
(14, 'Abhishek Jain', 'sample@mail.com', '1234567890', 'Technical Support', '', 'I need help installing the software.', '0', '2025-08-22 11:22:41'),
(15, 'Pooja Sinha', 'sample@mail.com', '1234567890', 'Complaint', '', 'The product packaging was damaged.', '0', '2025-08-22 11:28:59'),
(16, 'Sandeep Reddy', 'sample@mail.com', '1234567890', 'Partnership', '', 'Looking forward to collaborate with your company.', '0', '2025-08-22 11:33:15'),
(17, 'Divya Nair', 'sample@mail.com', '1234567890', 'Feedback', '', 'Very satisfied with the customer service.', '0', '2025-08-22 11:38:22'),
(18, 'Rajeev Malhotra', 'sample@mail.com', '1234567890', 'Request for Info', '', 'Could you send me your product catalog?', '0', '2025-08-22 11:43:31'),
(19, 'Ayesha Khan', 'sample@mail.com', '1234567890', 'Product Availability', '', 'Is product XYZ available in stock?', '0', '2025-08-22 11:49:49'),
(20, 'Nikhil Saxena', 'sample@mail.com', '1234567890', 'Demo Request', '', 'I would like to see a demo before purchase.', '0', '2025-08-22 11:55:10'),
(21, 'Swati Mishra', 'sample@mail.com', '1234567890', 'Refund Request', '', 'When will I receive my refund?', '0', '2025-08-22 12:00:22'),
(22, 'Ankur Bansal', 'sample@mail.com', '1234567890', 'Invoice Issue', '', 'Can you resend the invoice for my last order?', '0', '2025-08-22 12:05:38'),
(23, 'Shreya Kapoor', 'sample@mail.com', '1234567890', 'Delivery Query', '', 'Is same-day delivery possible?', '0', '2025-08-22 12:11:57'),
(24, 'Aditya Rao', 'sample@mail.com', '1234567890', 'Complaint', '', 'Wrong item delivered to me.', '1', '2025-08-22 12:16:43'),
(25, 'Meena Iyer', 'sample@mail.com', '1234567890', 'Product Info', '', 'Does the product come with warranty?', '0', '2025-08-22 12:22:11'),
(26, 'Harshit Gupta', 'sample@mail.com', '1234567890', 'Support Request', '', 'How can I reset my account password?', '0', '2025-08-22 12:27:09'),
(27, 'Nisha Thakur', 'sample@mail.com', '1234567890', 'Pricing', '', 'Do you offer discounts for students?', '0', '2025-08-22 12:33:25'),
(28, 'Varun Joshi', 'sample@mail.com', '1234567890', 'Collaboration', '', 'Interested in your affiliate program.', '0', '2025-08-22 12:39:47'),
(29, 'Ritu Desai', 'sample@mail.com', '1234567890', 'Feedback', '', 'The checkout process was smooth.', '0', '2025-08-22 12:44:35'),
(30, 'Deepak Chauhan', 'sample@mail.com', '1234567890', 'Complaint', '', 'Received a defective item.', '0', '2025-08-22 12:50:20'),
(31, 'Kavita Arora', 'sample@mail.com', '1234567890', 'Product Question', '', 'Do you sell spare parts separately?', '0', '2025-08-22 12:55:10'),
(32, 'Arjun Sethi', 'sample@mail.com', '1234567890', 'Support', '', 'I cannot login to my account.', '0', '2025-08-22 13:01:23'),
(33, 'Sonali Roy', 'sample@mail.com', '1234567890', 'Request for Quote', '', 'Please send me a quotation for 50 units.', '0', '2025-08-22 13:06:45'),
(34, 'Mohit Agarwal', 'sample@mail.com', '1234567890', 'Invoice', '', 'I need a GST invoice for my purchase.', '0', '2025-08-22 13:12:14'),
(35, 'Pallavi Jha', 'sample@mail.com', '1234567890', 'Refund', '', 'When will I receive my money back?', '0', '2025-08-22 13:17:32'),
(36, 'Tarun Sharma', 'sample@mail.com', '1234567890', 'Order Status', '', 'What is the current status of my order?', '0', '2025-08-22 13:23:10'),
(37, 'Geeta Menon', 'sample@mail.com', '1234567890', 'Feedback', '', 'Good quality product, keep it up.', '0', '2025-08-22 13:28:22'),
(38, 'Ajay Khanna', 'sample@mail.com', '1234567890', 'Complaint', '', 'The size I ordered does not fit.', '1', '2025-08-22 13:34:18'),
(39, 'Monika Dubey', 'sample@mail.com', '1234567890', 'Support Request', '', 'How do I change my delivery address?', '1', '2025-08-22 13:39:55'),
(40, 'Santosh Yadav', 'sample@mail.com', '1234567890', 'Career', '', 'Do you have internships available?', '1', '2025-08-22 13:45:12'),
(41, 'Poonam Malhotra', 'sample@mail.com', '1234567890', 'Product Return', '', 'I want to return my order due to defect.', '1', '2025-08-22 13:51:08'),
(42, 'Tarik Drake', 'sample@mail.com', '1234567890', 'Quia natus at non es', '', 'Amet voluptas et nu', '0', '2026-01-21 20:03:12'),
(43, 'Alexis Kelley', 'sample@mail.com', '1234567890', 'Sit hic aut quia at', '', 'Repellendus Nisi no', '0', '2026-01-21 20:05:15'),
(44, 'Florence Mayer', 'sample@mail.com', '1234567890', 'Excepteur quis ipsam', '', 'Nihil quis commodi b', '0', '2026-01-21 20:07:16'),
(45, 'Dexter Bernard', 'sample@mail.com', '1234567890', 'Provident autem vol', '', 'Mollitia anim incidu', '0', '2026-01-21 20:09:10'),
(46, 'Dawn Buckley', 'bapi@mailinator.com', '+1 (602) 805-12', 'Vitae quisquam exerc', 'Dolorem duis anim qu', 'Vitae enim accusanti', '0', '2026-02-01 18:47:01'),
(47, 'Brennan Rosario', 'kyvo@mailinator.com', '+1 (878) 557-85', 'Consequatur qui ipsa', 'Laudantium quo comm', 'Nostrud magni aliqui', '0', '2026-02-01 18:48:06'),
(48, 'Kirestin Dixon', 'jyred@mailinator.com', '+1 (976) 187-34', 'Reiciendis qui est q', 'Aut architecto labor', 'Laborum Fugiat aut', '0', '2026-02-01 18:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` varchar(2) NOT NULL,
  `status` varchar(2) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `email`, `type`, `status`, `last_login`) VALUES
(1, 'adego', '1234', 'Adego Admin', 'adegocommunication@gmail.com', '1', '1', '2026-02-11 16:20:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `career`
--
ALTER TABLE `career`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
