-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 17 juil. 2020 à 00:26
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_tp4`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_cat` int(3) NOT NULL,
  `titre_cat` varchar(255) NOT NULL,
  `nombre_products` int(3) NOT NULL DEFAULT 0,
  `icon` varchar(255) NOT NULL DEFAULT 'infinity' COMMENT 'icon-font-Awesome',
  PRIMARY KEY (`id_cat`),
  UNIQUE KEY `titre_cat` (`titre_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_cat`, `titre_cat`, `nombre_products`, `icon`) VALUES
(1, 'Baby', 0, 'baby'),
(2, 'Clothing', 0, 'tshirt'),
(3, 'Healthy & Beauty', 0, 'weight'),
(4, 'Electronics', 0, 'headphones-alt'),
(5, 'Watches & Accessiores', 0, 'watch');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id_prod` int(10) NOT NULL AUTO_INCREMENT,
  `titre_prod` varchar(500) NOT NULL,
  `Description` text NOT NULL,
  `image` varchar(400) NOT NULL,
  `prix` varchar(10) NOT NULL COMMENT 'en $',
  `id_cat` int(3) NOT NULL DEFAULT 0,
  `solds` int(11) NOT NULL DEFAULT 0 COMMENT 'number of solds',
  `best_offers` int(1) NOT NULL DEFAULT 0 COMMENT '0 : not best offers . 1: best offer',
  PRIMARY KEY (`id_prod`),
  KEY `cat_id` (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id_prod`, `titre_prod`, `Description`, `image`, `prix`, `id_cat`, `solds`, `best_offers`) VALUES
(7, 'Munchkin Click Lock Weighted Straw Cup, 7 Ounce, Blue', '<ul>\r\n    <li>7 ounce capacity for water, milk or juice </li>\r\n   <li> Weighted straw allows your toddler to hold the cup at any angle</li> \r\n   <li> Handles are easy for little hands to hold; BPA free </li>\r\n</ul>\r\n<br>\r\nWith Munchkin\'s weighted straw trainer cup, your toddler can hold it like a bottle but drink from a straw. The weighted straw cup dispenses liquid from any angle. And with the flip top lid and Click Lock functionality, this cup is also perfect for use on the go. Munchkin even backs this no leak promise with a 100 percent replacement guarantee! Secured, and rest assured this might just be the Sippy cup of your dreams. ', 'baby3.jpg', '6.54', 1, 18, 0),
(8, 'Munchkin White Hot Safety Spoons 4 Ct', '<ul>\r\n<li>Patented white hot heat sensor tips turn white when food is too hot</li>\r\n<li>Soft tips are gentle on baby\'s gums</li>\r\n<li>Bright colors help hide food stains</li>\r\n<li>Top rack dishwasher safe</li>\r\n<li>Tapered bowl is ideal for little mouths and comes in purple, pink, peach, and blue</li>\r\n</ul>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'baby2.webp', '17.89', 1, 0, 1),
(9, 'Edushape See-Me Sensory Balls, 4 Inch, Translucent, 4 Ball Set ', '<ul>\r\n<li>Plastic</li>\r\n<li>SENSORY ENGAGEMENT: Nubbly surface engages the senses and enhances tactile development </li>\r\n<li>MOTOR SKILL DEVELOPMENT: Gripping, tossing, bouncing, and rolling encourage growth of fine and gross motor skills </li>\r\n<li>ENHANCE LOGIC AND REASONING: Rolling, tracking, and bouncing enhance hand-eye coordination, visual sensory development, and logic & reasoning skills </li>\r\n<li>VISUALLY STIMULATING: Bright, colorful design engages visual senses and encourages color recognition skills </li>\r\n<li>Contains 4 pieces; Recommended for ages 6 months and up; Edushape products are made with BPA and phthalate free plastic </li>\r\n</ul>', 'baby1.jpg', '12.25', 1, 1, 0),
(10, 'Blige SMTF Cute Animal Soft Baby Socks Toys Wrist Rattles and Foot Finders ', '<ul>\r\n<li>Scientific studies into the healthy development of babies has lead to the creation of these adorable foot finders socks and baby wrist rattles for infants. </li>\r\n<li>These foot finders are a perfect choice for those interested in enhancing the sensory development of their baby. </li>\r\n<li>Highly recommended developmental toys for babies - Puts tons of fun within your baby\'s reach! </li>\r\n<li>Help your baby develop hand, foot and eye co-ordination.</li>\r\n<ul>', 'baby4.jpg', '9.99', 1, 2, 0),
(11, 'Summer Affirm 335 Rear-Facing Infant Car Seat, Stone Gray  – Lightweight and Convenient Car ', '<ul>\r\n<li>REAR-FACING CAR SEAT: The Summer Affirm 335 Rear-Facing car seat is designed to fit babies from 3-35 pounds, 15-32 inches. </li>\r\n<li>UNIQUELY DESIGNED CAR SEAT BASE: The Affirm Steeloc base makes installation of this car seat simple and easy, while providing the reinforcing strength of steel. Plus, it has dual level indicators and adjustable foot. </li>\r\n<li>ADDED LEVELS OF SURESHIELD PROTECTION: Front-Impact Tested, Side-Impact Tested, Rear-Impact Tested, Rollover Tested, 2X Impact Force Tested, Aircraft Approved, ASTM 2050 compliant; Meets or exceeds all applicable safety standards, including FMVSS 213.</li>\r\n<li>STROLLER COMPATIBILITY: The Affirm 335 car seat is for rear-facing vehicle use only and is compatible with the Summer Myria Modular Stroller, Summer Myria Travel System, Summer 3Dpac CS, and Summer 3Dpac CS lite stroller. </li>\r\n</ul>', 'baby5.jpg', '170.89', 1, 0, 0),
(12, 'Original Penguin Men\'s Long Sleeve Gingham NEP Woven Twill - Non-Stretch Shirt', '<ul>\r\n<li>99% Cotton/1% Other Fibers </li>\r\n<li>Button closure</li>\r\n<li>Collection: Original - Style OPWF8146OP </li>\r\n<li>MSRP - $89.00 / Button Up</li>\r\n<li>Button-Front </li>\r\n<li>Medium Weight </li>\r\n<ul>', 'clothing1.jpg', '23.76', 2, 0, 0),
(13, 'Starter Men\'s Short Sleeve Lightweight Logo Sweatshirt, Amazon Exclusive ', '<ul>\r\n<li>65% Polyester, 35% Cotton</li>\r\n<li>Imported </li>\r\n<li>Machine Wash</li>\r\n<li>Starter hangtag doubles as a sticker! </li>\r\n<li>Starter Sweats: Legendary Softness</li>\r\n<li>Amazon Exclusive, Men\'s Activewear</li>\r\n<ul>', 'clothing2.jpg', '25.89', 2, 1, 1),
(14, ' Goodthreads Men\'s Lightweight French Terry Short ', '<ul>\r\n<li>100% Cotton </li>\r\n<li>Imported </li>\r\n<li>Drawstring closure </li>\r\n<li>Machine Wash </li>\r\n<li>These soft terry cotton shorts are ready for a workout and equally lounge-worthy </li>\r\n<li>With a pull on banded waistband, two off-seam side pockets, a self-tie drawstring and accent stitching details </li>\r\n<ul>', 'clothing3.jpg', '25.38', 2, 3, 0),
(15, 'Thobisy Mens Shorts Casual Cotton Workout Elastic Waist Short Pants Drawstring ', '<ul>\r\n<li>Drawstring closure </li>\r\n<li>Keep Dry and Comfortable: 70% Cotton, 25% Polyester, 5% Elastane,soft & stretchy fabric wicks sweat away and helps keep you dry and comfortable. </li>\r\n<li>Elastic Waistband: Elastic waistband with internal draw cord can perfect suit your waist, which makes you can do the exercises without anxiety. </li>\r\n<li>Ventilation & Breathable: Excellent breathable material for ventilated comfort and freedom to move. Good flexibility allows greater mobility & maintains shape and enhance breathability to help you stay cool. </li>\r\n<li>Convenience: Two side pockets and back right side zippered storage pocket keeps your valuables secure.</li>\r\n<li>Any problem you encounter, please contact us.Your opinion will make us better. Now please add it to the shopping cart. </li>\r\n<ul>', 'clothing4.jpg', '17.92', 2, 0, 0),
(16, ' Y-3 Men\'s Raito Racer Sneakers ', 'Color: Ftwwht/Black/Sorang\r\n<ul>\r\n<li>Imported </li>\r\n<li>Fabric: Ripstop</li>\r\n<li>Rubber sole </li>\r\n<li>Neon color is brighter than it appears in still photos, Lightly padded collar and tongue, Removable insole</li>\r\n<li>Lace-up closure</li>\r\n<li>Imported, China</li>\r\n<ul>\r\n', 'clothing5.jpg', '99.99', 2, 1, 1),
(17, ' MCM Women\'s Visetos Slide ', '<ul>\r\n<li>Made in USA or Imported </li>\r\n<li>Indulge in a look of carefree cool when you slip into the MCM™ Visetos Slide.</li>\r\n<li>Visetos coated synthetic upper with signature brand logo emblem print. </li>\r\n<li>Slip-on design. </li>\r\n<li>Open-toe silhouette.</li>\r\n<li>Soft synthetic lining. Lightly cushioned footbed. Treaded rubber sole in camouflage pattern. Made in Italy. Measurements: Weight: 6 oz Product measurements were taken using size 39 (US Women\'s 9), width M. Please note that measurements may vary by size. Weight of footwear is based on a single item, not a pair. </li>\r\n<ul>', 'clothing6.jpg', '125.78', 2, 0, 0),
(18, 'UGG Kids Girl\'s Fluff Yeah Slide (Little Kid/Big Kid) ', '<ul>\r\n<li>Made in USA or Imported </li>\r\n<li>Fur Animal - Sheep or Lamb. Fur Country of Origin - Australia, United Kingdom, Ireland, United States or Spain. Fur Treatment - Dyed. More than 10% from scraps - No </li>\r\n<li>Rubber sole </li>\r\n<li>10mm sheepskin upper</li>\r\n<li>Elastic strap with UGG graphic </li>\r\n<li>10mm sheepskin lining </li>\r\n<ul>', 'clothing7.jpg', '75.50', 2, 41, 1),
(19, ' Levi\'s Women\'s 721 High Rise Skinny Jeans ', '<ul>\r\n<li>92% Cotton, 6% Elastomultiester, 2% Lycra Spandex </li>\r\n<li>Imported </li>\r\n<li>Zipper closure</li>\r\n<li> Wash And Dry Inside Out With Like Colors; Liquid Detergent Is Recommended </li>\r\n<li>High Rise: Sits above waist </li>\r\n<li>Slim through hip and thigh</li>\r\n<ul>', 'clothing8.jpg', '50.49', 2, 0, 0),
(20, 'Cover Girl Women\'s Juniors and plus size ripped distressed tight skinny jeans ', '<ul>\r\n<li>98% Cotton, 2% Spandex </li>\r\n<li>Zipper closure</li>\r\n<li>Machine Wash </li>\r\n<li>Distressed jeans collection: great quality stretch cotton for perfect distressed denim hottest celebrity trend. Please use the size chart or order a size up than normal for best results </li>\r\n<li>Plus size jeans: low or mid rise flattering jeans for women of all sizes. You will love the way you look. The leader in plus size skinny jeans for women. Sexy jeans waist with comfort strip</li>\r\n<ul>', 'clothing10.jpg', '29.89', 2, 0, 1),
(21, 'Summer Dresses for Women Floral Spaghetti Strap Dress with Pockets', '<ul>\r\n<li>100% Rayon </li>\r\n<li>Material: 100% Rayon.Soft and comfortable. </li>\r\n<li>Midi dress with pockets,spaghetti strap,side splits,Hawaiian floral pattern. </li>\r\n<li>Casual summer dresses for women,suits for daily wear,date,party,lounging or beach </li>\r\n<li>Loose fit, little \"A\" shape. Please read left size chart before ordering.Reference: Model 5\'7 ft./120 lbs.(Chest 33.9\"- Waist 23.6\"-Hip 34.6\"）wears size XS. </li>\r\n<ul>', 'clothing11.jpg', '16.50', 2, 0, 0),
(22, 'Colgate Extra Clean Full Head Toothbrush, Medium - 4 Count ', '<ul>\r\n<li>Circular power bristles to help effectively clean teeth</li>\r\n<li>Easy-to-grip handle to provide comfort and control while brushing </li>\r\n<li>Cleaning tip bristles to effectively reach and clean back teeth and between teeth </li>\r\n<li> Helps remove tooth stains </li>\r\n<li> Helps remove tooth stains </li>\r\n<li>Colors will vary </li>\r\n<ul>', 'health.webp', '2.99', 3, 0, 0),
(23, 'Gillette Foamy Shaving Cream, Sensitive Skin, 11 Ounce ', '<ul>\r\n<li>Simple. Honest. Classic.</li>\r\n<li>Shaving foam lightly fragranced for sensitive skin </li>\r\n<li>Instant lather spreads easily and rinses clean</li>\r\n<li>Comfort Glide formula reduces friction </li>\r\n<li>Use Gillette Foamy Sensitive Skin Shaving Foam with any Gillette razor </li>\r\n</ul>\r\n        ', 'health2.jpg', '2.25', 3, 1, 1),
(24, 'Cetaphil Daily Facial Cleanser for Normal to Oily Skin, Gentle Face Wash for Sensitive Skin, 16 oz ', '<ul>\r\n<li>Gentle Enough for Everyday Use; Mild and non irritating formula is perfect for normal to oily skin and is suitable for even the most sensitive skin </li>\r\n<li>Clinically Proven to Deep Clean Skin: Cleanses Without Leaving Skin Feeling Dry </li>\r\n<li>Skin Feels Refreshed & Moisturized: Low Lather Formula Will Not Strip Skin of Essential Oils, Which Can Leave Skin Feeling Dry and Tight </li>\r\n<li>Removes Oils & Dirt: Hypoallergenic Facial Cleanser Is Gentle Enough for Morning and Night Use and Is Clinically Proven to Deep Clean Skin and Remove Oils, Dirt and Makeup </li>\r\n</ul>\r\n        ', 'health3.jpg', '10.50', 3, 1, 0),
(25, 'NIVEA Men DEEP Active Clean Body Wash - 8-hour Fresh Scent with Natural Charcoal', '<ul>\r\n<li>Deep Cleansing Charcoal Body Wash</li>\r\n<li>Draws out dirt, oil and sweat like a magnet </li>\r\n<li>Deeply cleanses skin without drying </li>\r\n<li>Fresh scent lasts at least 8 hours </li>\r\n<li>Dermatologically tested </li>\r\n</ul>\r\n        ', 'health4.jpg', '4.59', 3, 1, 0),
(26, 'Sunbeam Heating Pad for Pain Relief | XL King Size UltraHeat, 3 Heat Settings with Moist Heat', '<ul>\r\n<li>King-size electric heating pad provides soothing heat relief and has an easy-to use controller specifically designed for arthritis sufferers </li>\r\n<li>Heat pad includes sponge so it can be used with moist or dry heat</li>\r\n<li>3 heat settings so you can customize the intensity of heat </li>\r\n<li>Soft, washable cover</li>\r\n<li>9-foot cord lets you relax wherever you need to </li>\r\n</ul>\r\n        ', 'health6.jpg', '18.46', 3, 0, 0),
(27, 'Heated Neck Wrap, ARRIS Neck Heating Wrap with Adjustable Time and Temperature Control', '<ul>\r\n<li>【New Technology is More Safer and Efficient】- The ARRIS heated neck wrap adopts the latest graphene heating technology, compare to traditional carbon fiber heating system, it is more safer and can generate more averaged heat to human body. </li>\r\n<li>【Deep Relaxation Heat Neck Wrap】- This heated neck brace focused on solving problems concerning neck stiffness and soreness. Heats in seconds, provides ultra comfortable hot therapy for neck. Especially ideal for writers, students, teachers and those who usually use computers. </li>\r\n<li>【Easy and Convenient to Use】- This neck heating pad can be used anytime anywhere. Just simply plug it to a PC, power bank or USB adapter, it could work. You can use it at home or office for a short break, longtime traveling to relieve fatigue, muscle stiffness and sore neck. Perfect as birthday gift, thanksgiving gift and Christmas gift. </li>\r\n</ul>\r\n        ', 'health5.jpg', '25.00', 3, 0, 0),
(28, 'Orgain Organic Plant Based Protein Powder, Creamy Chocolate Fudge - Vegan ', '<ul>\r\n<li>Includes 1 (2.03 Pound) Orgain Organic Plant Based Creamy Chocolate Fudge Protein Powder </li>\r\n<li>21 grams of organic plant based protein (pea, brown rice, chia seeds), 6 grams of organic dietary fiber, 4 grams of net carbs, 0 grams of sugar, 150 calories per serving </li>\r\n<li>Mix with water, milk, or your favorite protein shake recipe for a quick breakfast or snack drink. Use when bakin grams to give your cakes, muffins, brownies, or cookies a protein and energy boost </li>\r\n<li>Ideal for healthy, on the go nutrition for men, women, and kids. These are great for meal replacement, smoothie boosters, buildin grams lean muscle, muscle recovery, and pre or post workouts </li>\r\n<li>We simply advise against using a microwave as it may negatively impact the nutritional value of the product. </li>\r\n</ul>\r\n        ', 'health7.jpg', '23.50', 3, 1, 0),
(29, 'Moroccan Kamama', '<ul>\r\n<li>Against The virus</li>\r\n<li>Allows the passage of fresh air</li>\r\n<li>Use more than four hours</li>\r\n<li>Suitable Price</li>\r\n<li>Protect from the fine</li>\r\n</ul>\r\n        ', 'health1.jpg', '1.00', 3, 0, 1),
(30, 'Bluetooth 5.0 Wireless Earbuds with Wireless Charging Waterproof Stereo Headphones ', '<ul>\r\n<li>[TWS & BLUETOOTH 5.0] - Adopt the most advanced Bluetooth 5.0 technology TOZO T10 Support HSP HFP A2DP AVRCP Provides in-call stereo sound Also own fast and stable transmission without tangling. </li>\r\n<li>[Hi-fi stereo sound quality] - TOZO T10 offers a truly authentic sound and powerful bass performance with 8mm large size speaker driver - the drive area is 1.77 times than the normal drive area. </li>\r\n<li>[One step pairing] - Pick up 2 headsets from charging box They will connect each other automatically then only one step easily enter mobile phone Bluetooth setting to pair the earbuds. </li>\r\n<li>[IPX8 waterproof]- Earbuds and charging case inner Nano-coating makes it possible to waterproof for 1 meters deep for 30 minutes. It is suitable for sports to prevent water. Ideal for sweating it out at the gym . Even Wash the earbuds and base. </li>\r\n</ul>\r\n        ', 'electronics6.jpg', '39.99', 4, 2, 0),
(31, 'Corsair Harpoon PRO - RGB Gaming Mouse - Lightweight Design - Optical Sensor ', '<ul>\r\n<li>Incredibly lightweight at just 85G so that you can play even longer </li>\r\n<li>Contoured shape and rubber side grips let you play in Lasting comfort with a confident grip </li>\r\n<li>Ready to game right out of the box—just plug in through a USB port and start taking down the competition</li>\r\n<li>Play with the precise control you need to win thanks to a 12 000 DPI optical sensor for high-accuracy tracking </li>\r\n<li>Create an in-game advantage with six fully programmable buttons for anything from Remaps TO complex custom macros </li>\r\n</ul>\r\n        ', 'electronics1.jpg', '28.99', 4, 0, 0),
(32, 'KLIM Wind Laptop Cooling Pad - Support 11 to 19 Inches Laptops Phone', '<ul>\r\n<li>AN INVESTMENT. This cooling pad is an investment => no component overheating => maximises the life expectancy of your PC and boosts its performances. ✔ BONUS : Receive a free copy of the eBook: 7 tips to keep your computer alive and maximise its performance by email after your purchase. </li>\r\n<li>LARGE MODEL. Covers the following sizes : 11 11,3 12 13 14 15 15,6 16. Compatible with the following sizes : 17,3 18 and 19 inches. With these sizes, the laptop will extend over the edges of the cooler pad but will remain perfectly stable. KLIM Wind itself is extremely stable, it will stay completely still. </li>\r\n<li>THE MOST POWERFUL ON THE MARKET. 4 fans spinning up to 1200 rotations per minute. It’s a high capacity ventilated support with the ability to cool your PC to reasonable temperatures in under a minute. These 4 fans allow for cooling of all the areas of your laptop.</li>\r\n<li>THOUGHT OUT DESIGN + BUILT TO LAST. KLIM Wind is a level above the other ventilated supports in terms of design and the quality of materials used. We offer a 5 year warranty, proving our confidence in our product. It’s a no risk purchase. </li>\r\n</ul>\r\n        ', 'electronics2.jpg', '34.97 ', 4, 0, 0),
(33, 'FYY Case for iPhone 8/iPhone 7/iPhone SE (2nd) 2020 4.7', '<ul>\r\n<li>Unique RFID Blocking Technique: Radio Frequency Identification technology, through radio signals to identify specific targets and to read and copy electronic data. Most Credit Cards, Debit Cards, ID Cards are set-in the RFID chip, the RFID reader can easily read the cards information within 10 feet(about 3m) without touching them. This case is designed to protect your cards information from stealing with blocking material of RFID shielding technology.</li>\r\n<li>Specifically for iPhone 8 2017/iPhone 7 2016/iPhone SE(2nd) 2020 4.7\". Top quality. Made with Premium PU Leather. 100% Handmade. </li>\r\n<li>Large Capacity. Card slots and Note Holder provide you to put debit card, credit card, ID card, receipts or some change while on the go. </li>\r\n<li>Multiple Functions. Kickstand function is convenient for movie-watching or video-chatting. Easy access to all ports and controls. </li>\r\n</ul>\r\n        ', 'electronics3.jpg', '8.99', 4, 0, 1),
(34, 'Tribe Water Resistant Cell Phone Armband Case for iPhone 11, 11 Pro Max, Xs Max', '<ul>\r\n<li>UNIVERSAL PHONE ARMBAND – Our premium running armband is designed to fit all plus size smartphones (see fitment guide below). A perfect hands-free solution for your smartphone so you can focus on your workouts. Enhanced with weatherproof technology to keep your phone safe and protected from rain or sweat, and an extra-thick reflective strip for safe running at night. </li>\r\n<li>FULL TOUCHSCREEN FUNCTIONALITY – Our encased running armband acts as a workout phone holder while offering full protection and allowing easy access to your phone’s touchscreen functionality and headphone jack. </li>\r\n<li>NO SLIP DESIGN – Unlike lower quality armbands, our premium running armbands are designed with the highest quality materials, including an extra-plush, adjustable elastic band to provide optimal comfort and fitment. Your phone is guaranteed to stay in place during the toughest workouts. </li>\r\n</ul>\r\n        ', 'electronics4.jpg', '14.96', 4, 0, 0),
(35, 'COWIN E7 Active Noise Headphones Bluetooth Headphones with Microphone', '<ul>\r\n<li>Professional Active Noise Cancelling Technology. Significant noise reduction for travel, work and anywhere in between. Advanced active noise reduction technology quells airplane cabin noise, city traffic or a busy office, makes you focus on what you want to hear,enjoy your music, movies and videos. The noise cancellation function can work well both in wire and wireless mode. </li>\r\n<li>Proprietary 40mm Large-aperture Drivers. Deep, accurate bass response. The Active Noise Cancelling around-ear headphones from COWIN give you crisp, powerful sound and quiet that helps you enjoy your music better. The goal that provide Customers with better sound quality, is our constant pursuit. </li>\r\n<li>High-quality Built-in Microphone and NFC Technology. COWIN E7 provides high-quality built-in microphone for hands-free calls, Which is convenient for you to free yourself from wires. NFC pairing aided by voice prompts, promises quick and stable connection with your Bluetooth enabled devices, Powerful Bluetooth Function. </li>\r\n</ul>\r\n        ', 'electronics5.jpg', '59.99', 4, 1, 0),
(36, 'MSI GL65 Leopard 15.6 FHD 144Hz 3ms Thin Bezel Gaming Laptop ', '<ul>\r\n<li>15.6\" FHD IPS-Level 144Hz 72%NTSC Thin Bezel close to 100%Srgb NVIDIA GeForce RTX 2070 8G GDDR6 </li>\r\n<li>Intel Core i7-10750H 2.6-5.0GHz Intel Wi-Fi 6 AX201(2*2 ax) </li>\r\n<li>512GB NVMe SSD 16GB (8G*2)DDR4 2666MHz 2 Sockets Max Memory 64GB </li>\r\n<li>USB 3.1 Gen2 Type C *1 USB 3.2 Gen1 *3 Steel Series per-Key RGB with Anti-Ghost key+ silver lining 720p HD Webcam </li>\r\n<li>Win10 Multi-language Giant Speakers 3W*2 6 cell (51Wh) Li-Ion 230W </li>\r\n</ul>\r\n        ', 'electronics.webp', '1,399.00', 4, 0, 0),
(37, 'GoPro Dual Battery Charger + Battery (HERO8 Black / HERO7 Black / HERO6 Black)', '<ul>\r\n<li>Conveniently charges two GoPro batteries simultaneously </li>\r\n<li>Charges via USB port for faster charging, or via the optional GoPro Supercharger (International Dual‑Port Charger) </li>\r\n<li>Dual LED lights display charging status of both batteries</li>\r\n<li>Includes a spare 1220mAh lithium‑ion rechargeable battery </li>\r\n<li>Allows you to charge your spare batteries while you use your camera </li>\r\n</ul>\r\n        ', 'electronics7.jpg', '45.99', 4, 0, 0),
(38, ' PlayStation 4 Console - 1TB Slim Edition ', '<ul>\r\n<li>Includes a new slim 1TB PlayStation  4 system, a matching DualShock 4 Wireless Controller. </li>\r\n<li>Play online with your friends, save games online and more with PlayStation Plus membership (sold separately). </li>\r\n<li>All the greatest, games, TV, music and more. Connect with your friends to broadcast and celebrate your epic moments at the press of the Share button to Twitch, YouTube, Facebook and Twitter.</li>\r\n<li>Mount is not included </li>\r\n</ul>\r\n        ', 'electronics8.jpg', '334.87', 4, 0, 1),
(39, 'HunYUN Fashion Simple Minimalist Watches Women Alloy Bracelet Quartz Wrist Watch', '<ul>\r\n<li>Wonderful Gifts for Women: 】It comes with nice gift box, it can be a perfect gift for women on Wedding, Prom, Parties, Birthday, Christmas,Valentine\'s Day, Mother\'s Day or Anniversary</li>\r\n<li>★ Cute and fashionable looking will add simple elegance to your accessories, it goes with multiple outfits and occasions. It’s lightweight also, won\'t feel heavy or sweaty. </li>\r\n<li>★ Water resistant to 30m (100ft): in general, withstands splashes or brief immersion in water, but not suitable for swimming or bathing</li>\r\n<li> Minimalist & Ultra Thin Design ★: Minimalist design, ultra thin watch case, unique small dial for seconds, 30M waterproof. High quality watch will be a perfect gift for your relatives and friends </li>\r\n</ul>\r\n        ', 'waches.jpg', '8.86', 5, 0, 0),
(40, 'Invicta Men\'s Pro Diver Quartz Watch with Stainless Steel Strap, Two Tone, 20 (Model: 26972) ', '<ul>\r\n<li> Shape  :  	Round</li>\r\n<li> Display  : Analog</li>\r\n<li> Blue dial, Two tone stainless steel band </li>\r\n<li> 40mm stainless steel case;Push/pull crown;Flame Fusion crystal </li>\r\n<li> 200 meter water resistant </li>\r\n</ul>\r\n        ', 'waches1.jpg', '57.19', 5, 1, 1),
(41, 'Metme Flapper Headband Bling Rhinestone Pearl Wedding Headpiece 1920s Gatsby Themes', '<ul>\r\n<li>Gatsby Headpiece Size: Free size. High quality silk bands, you can adjust the size of this headpiece according to your own preferences. </li>\r\n<li>Fashion Design: Leaves and medallion deco with pearl and crystal, luxurious and graceful. </li>\r\n<li>Beautiful pearl pendant in the forehead, retro and elegant, make you look like the queen of the prom. </li>\r\n<li>1920s headpiece headband perfectly match with various Event, Formal Party, Cocktail, Wedding, Halloween, Thanksgiving, Christmas, 1920s Great Gatsby Party, Flapper Party and Anniversary. </li>\r\n<li>It\'s a perfect accessory for any outfit, not only formal outfit but leisure outfit. It is outstanding gift for mother, wife, girlfriend. </li>\r\n</ul>\r\n        ', 'accessoires.jpg', '12.23', 5, 0, 0),
(42, 'Glitter Sparkly Bows Clips for Girls Hair Pin Rainbow Hair Bows for Hair Accessoires ', '<ul>\r\n<li>Name:3inch Glitter Hair Bows, Rainbow hair bows clip </li>\r\n<li> Quantity:12pcs 1pcs each color as showing </li>\r\n<li> Fit for:More than 1years old baby,girls, toddlers,teens,children,kids,young girls adult </li>\r\n<li> Used for:party gift, Birthday gift,back to school gift,Very Cute as gift for everyone </li>\r\n<li>It is very easy to use and take off when you wear, Glitter Bow hair Clip,100% Handmade</li>\r\n</ul>\r\n        ', 'accessoires1.jpg', '9.99', 5, 0, 0),
(43, ' murtoo Leather and Steel Bracelet for Men, Red Black and Brown Braided Leather', '<ul>\r\n<li>Leather and Steel Bracelet-Crafted Leather Connected with Black and Silver Steel Chain, Retro Texture mixed with Fashion. It is a excellent bracelet for men. </li>\r\n<li>Excellent Craftsmanship: The Mens Bracelet was made with Luxury Crafted Leather Material,excellent stainless steel chain and magnetic clasp, Strong and Durable.This unique mens bracelet is perfect to wear alone or ideal to stack with others. </li>\r\n<li>Mens Bracelet Size:Bracelet total Length: 8\"(21.5cm) Fit for the wrist length of 7.5\'\'-7.7\". Open way: you lift and twist the steel magnetic buckle of the leather bracelet. This bracelet got a up and down style magnetic clasp. </li>\r\n<li>Awesome For Gifts: Package comes with a beautiful murtoo brand box for you to store the bead bracelet. A great gift for families/friends in valentine\'s day, anniversary, father\'s day, Christmas, birthday, thanksgiving day. It also can be a great graduation gift. </li>\r\n</ul>\r\n        ', 'accessoires2.jpg', '17.99', 5, 0, 0),
(303, 'test', '<ul>\r\n<li></li>\r\n<li></li>\r\n<li></li>\r\n<li></li>\r\n<li></li>\r\n</ul>\r\n        ', 'audio book.jpg', 'test', 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int(10) NOT NULL AUTO_INCREMENT,
  `id` int(10) NOT NULL COMMENT 'Id user',
  `id_prod` int(10) NOT NULL COMMENT 'id items',
  `date` date NOT NULL COMMENT 'Date of commande',
  PRIMARY KEY (`id_order`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id_order`, `id`, `id_prod`, `date`) VALUES
(186, 14, 28, '2020-07-09'),
(185, 14, 16, '2020-07-09'),
(184, 14, 35, '2020-07-09'),
(183, 1, 40, '2020-07-09'),
(182, 1, 13, '2020-07-09');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `status_site` varchar(100) NOT NULL DEFAULT 'work' COMMENT 'platform status (work or repair)',
  `dst_prtn` varchar(255) NOT NULL DEFAULT 'AL AMANA' COMMENT 'distribution partner',
  `TEL_HELP` varchar(13) NOT NULL DEFAULT '+212706363931',
  `EMAIL_HELP` varchar(255) NOT NULL DEFAULT 'fawzichilouh@gmail.com'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`status_site`, `dst_prtn`, `TEL_HELP`, `EMAIL_HELP`) VALUES
('work', 'AL AMANA', '+212712345678', 'fawzichilouh@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `numbers_sells` int(5) NOT NULL,
  `numbers_cart` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stats`
--

INSERT INTO `stats` (`numbers_sells`, `numbers_cart`) VALUES
(70, 18);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(300) NOT NULL,
  `email` varchar(400) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `country` varchar(60) NOT NULL,
  `type_user` int(2) NOT NULL DEFAULT 0 COMMENT 'Pour Distinguer entre users et les admines (0 : normal user  ,1 :admin )',
  `suspended` int(3) NOT NULL DEFAULT 0 COMMENT 'if the clients is suspended ,can''t buy anything . ',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf32 COMMENT='TABLE DE UTILISATEURS ET LES ADMINES';

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `tel`, `password`, `adresse`, `country`, `type_user`, `suspended`) VALUES
(2, 'Client1', 'My  Client', 'client@gmail.com', '123456789', 'Client1', 'N 123 Client1 Example', 'Example', 0, 0),
(3, 'client2', 'My Client 2', 'Client2@client.com', '061214567', 'Client2', 'N 123 Client2 Example Example', 'USA', 0, 1),
(6, 'admin', 'admin', 'admin@admin.com', '0721678112', 'admin', 'adminastartion national', 'admin', 1, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_id` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
