-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 05:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `age` int(12) NOT NULL,
  `animal_type` int(12) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `gender` int(12) NOT NULL,
  `owner_id` int(12) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `name`, `image`, `age`, `animal_type`, `breed`, `description`, `gender`, `owner_id`, `created_at`, `status`) VALUES
(1, 'Ollie', 'https://upload.wikimedia.org/wikipedia/commons/e/e8/Sphinx2_July_2006.jpg', 1, 1, 'Sphynx', 'Ollie is a unique and affectionate Sphynx cat. Despite his lack of fur, he\'s always warm-hearted and loves cuddling up with his human companions.', 1, 2, '2024-03-14', 0),
(14, 'Mila', 'http://localhost/animal/uploads/fcb2502f6e95c655f9ab18a064f6a118.jpeg', 1, 2, 'Himalayan', 'Mila is a stunning Himalayan cat with a luxurious long coat and striking blue eyes. Her calm demeanor and affectionate nature make her the perfect lap cat.', 2, 8, '2024-03-15', 1),
(15, 'Lily', 'http://localhost/animal/uploads/dan-wayman-Paw3cZH_YCY-unsplash-scaled.jpg', 2, 2, 'Exotic Shorthair', 'Lily is an Exotic Shorthair cat with a sweet and easygoing personality. Her plush coat and round face make her irresistibly adorable and huggable.', 2, 8, '2024-03-16', 1),
(19, 'Sadie', 'http://localhost/animal/uploads/5e2cf55e0a2603b8090dd48befe66827.jpg', 4, 1, 'Siberian Husky', 'Sadie is an energetic and independent Siberian Husky with striking blue eyes. She loves outdoor activities and thrives in colder climates.\r\n', 2, 8, '2024-03-16', 0),
(20, 'Sophie', 'http://localhost/animal/uploads/d9e129d8e12382192fca41fb4cddaf83.jpg', 2, 1, 'Golden Retriever', 'Sophie is a gentle and affectionate Golden Retriever with a heart of gold. Her love for people and her friendly nature make her an ideal family pet.\r\n', 2, 8, '2024-03-16', 0),
(21, 'Felix', 'http://localhost/animal/uploads/640123e52530f8e411840977527c9048.jpg', 2, 2, 'Manx', 'Felix is a playful and tailless Manx cat with a boundless curiosity. He\'s always on the lookout for new adventures and interesting things to pounce on.\r\n', 1, 8, '2024-03-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `animal_category`
--

CREATE TABLE `animal_category` (
  `id` int(12) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal_category`
--

INSERT INTO `animal_category` (`id`, `cat_name`) VALUES
(1, 'Dog'),
(2, 'Cat');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(12) NOT NULL,
  `text` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `user_id` int(12) NOT NULL,
  `animal_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `text`, `updated_at`, `created_at`, `user_id`, `animal_id`) VALUES
(1, 'Very Nice', '2024-03-14 19:59:29', '2024-03-14 19:59:29', 1, 1),
(10, 'this is new comment', '2024-03-16 14:03:08', '2024-03-16 14:03:08', 8, 1),
(11, 'aaaaaaa', '2024-03-16 14:53:54', '2024-03-16 14:30:45', 8, 1),
(14, 'hello bd', '2024-03-16 14:55:27', '2024-03-16 14:55:20', 8, 1),
(15, 'nice', '2024-03-25 14:59:51', '2024-03-16 18:06:25', 8, 15),
(16, 'Awesome❤️💕', '2024-03-16 18:54:22', '2024-03-16 18:54:09', 8, 0),
(17, 'Awesome 💕❤️', '2024-03-16 18:55:46', '2024-03-16 18:54:58', 8, 0),
(18, 'Awesome 💕😍❤️', '2024-03-16 18:57:44', '2024-03-16 18:56:41', 8, 0),
(19, 'Awesome👌👌👌👌👌👌', '2024-03-16 18:58:46', '2024-03-16 18:58:46', 8, 16);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(12) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `type`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `animal_id` int(12) NOT NULL,
  `status` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `animal_id`, `status`) VALUES
(1, 1, 1, 1),
(20, 0, 15, 1),
(21, 0, 1, 1),
(23, 0, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `user_name`, `pass`, `email`, `created_at`) VALUES
(1, 'Ariful Islam', 'Arif19', '$2y$10$I0OGUHYJhRs9nYnEaJyfU.3M0UqdcUlLAuoxmWyqy8hbCXobIlqQS', 'arifulislam758143@gmail.com', '2024-03-14'),
(8, ' ', 'mizan', '$2y$10$WVgDGWku9ee69DeXC1IKw.SpiITZaCw3l3bo1uOBMMIsz9OmJwtd6', 'mizan@me.com', '2024-03-14'),
(16, ' ', 'akil', '$2y$10$gTQSo/RpisPEP8w74WhZGuqe4pix68pRF2OMALsRDYZQBdNGrZRa.', 'akil@akil.com', '2024-03-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animal_category`
--
ALTER TABLE `animal_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
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
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `animal_category`
--
ALTER TABLE `animal_category`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
