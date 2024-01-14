-- MySQL dump 10.13  Distrib 5.6.45, for Linux (x86_64)
--
-- Host: localhost    Database: s1094663
-- ------------------------------------------------------
-- Server version	5.6.45-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sup_config`
--

DROP TABLE IF EXISTS `sup_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sup_config` (
  `k` text NOT NULL,
  `v` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sup_config`
--

LOCK TABLES `sup_config` WRITE;
/*!40000 ALTER TABLE `sup_config` DISABLE KEYS */;
INSERT INTO `sup_config` VALUES ('gg','<!--后台公告-->\n          <a href=\"/classlist.php\" target=\"_blank\" class=\"list-group-item\"><span class=\"pull-right\"> </span><em class=\"fa fa-fw fa-volume-up mr\"></em><font color=\"#0f62f1\">[2019-08-24]供货商做不了的业务不要上架，上架的业务做不了请及时在商品编辑里下架商品。发现两次以上封账号，长时间不处理订单且联系不回应的封账号！<img border=\"0\" width=\"32\" src=\"http://pay.hackwl.cn/uploads/20190331/964d510402c2328d6e37e4793c6868d5.gif\"></font></a>\n           			                    <div class=\"panel-group\" id=\"accordion\">   \n               <div class=\"panel panel-default\">\n            <div class=\"panel-heading\">\n       <h4 class=\"panel-title\">\n  <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseTwo\" class=\"collapsed\" aria-expanded=\"false\">供货商相关说明</a>\n         </h4>\n      </div>\n    <div id=\"collapseTwo\" class=\"panel-collapse collapse\" style=\"height: 0px;\" aria-expanded=\"false\">\n        <div class=\"panel-body\">\n   <span style=\"color:#EE33EE;\">1.通过商品管理添加商品到平台销售获得酬劳！</span><br>\n   <span style=\"color:#EE33EE;\">2.没有商品货源可以到其他平台找到货源到本平台销售（如流量刷、亿乐社区等平台）</span><br>\n   <span style=\"color:#EE33EE;\">3.有用户下单后可以在订单管理中查看，处理完成把订单状态改为完成即可获得余额（余额可提现到微信、支付宝、QQ等【提现费率及提现要求可联系站长商量，默认提现最低10元，费率百分之五】）</span><br>\n   <span style=\"color:#EE33EE;\">4.商品添加成功后是在平台不可见的，须通过平台审核后方可见（平台会在每天不定时审核，着急可联系平台客服加急）</span><br>\n          <span style=\"color:#EE33EE;\">5.严禁出售黄赌毒等违反国家规定等商品，一经发现立即关闭相关权限永不收录！</span><br>\n          <span style=\"color:#f0ad4e;\">6.严禁脱离平台交易，一经发现立即封禁账号扣除余额及保证金！</span><br>\n          <span style=\"color:#f04e66;\">7.平台不强制缴纳保证金，缴纳的保证金也可随时取出！</span><br>\n          <span style=\"color:#f04e66;\">8.缴纳保证金的供货商提现当天到账，后期商品介绍也会显示（缴纳保证金最低100元）！</span><br>\n          <span style=\"color:#337ab7;\">9.供货商在24小时内未处理订单，平台有权将订单退款处理并不做通知（一些特殊业务需要长时间处理审核则将订单状态改为处理中）</span><br>\n	     </div>\n        </div>\n   </div>\n	<div class=\"panel panel-default\">\n      <div class=\"panel-heading\">\n     <h4 class=\"panel-title\">\n    <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseThree\" class=\"collapsed\" aria-expanded=\"false\">商品推广</a>\n         </h4>\n       </div>\n    <div id=\"collapseThree\" class=\"panel-collapse collapse\" style=\"height: 0px;\" aria-expanded=\"false\">\n        <div class=\"panel-body\">\n		<span style=\"color:#EE33EE;\">1.商品审核通过后即在平台显示，如果需要平台的推广需支付部分费用！</span><br>\n   <span style=\"color:#EE33EE;\">费用详细：全平台（包括本站全部代理分站）首页图片推广128元一月，主站首页图片推广38元一月，APP首页轮播图推广18元一月，本站代理群、交流群等发公告8元.更多请联系本站（满10元代做相关图片）</span><br>\n		   </div>\n            </div>\n      </div>\n       <div class=\"panel panel-default\">\n        <div class=\"panel-heading\">\n        <h4 class=\"panel-title\">\n      <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseFourth\" class=\"collapsed\" aria-expanded=\"false\">联系我们</a>\n        </h4>\n       </div>\n    <div id=\"collapseFourth\" class=\"panel-collapse collapse\" style=\"height: 0px;\" aria-expanded=\"false\">\n        <div class=\"panel-body\">\n		<center><h5><a target=\"_blank\" style=\"color:#CD2626\" href=\"\">QQ：2984446297</a></h5></center>\n<center><h5 style=\"color:#CD2626\">微信：</h5></center>\n		</div>\n          </div>\n    </div>\n<br>\n<div style=\"text-align:center;\">友情链接：<a href=\"http://www.xingyupay.com\" target=\"_blank\">星宇易支付</a> <a href=\"http://ds.xingyupay.com\" target=\"_blank\">授权平台</a> <a href=\"http://idc.xingyupay.com\" target=\"_blank\">星宇云</a> <a href=\"https://www.xingyubk.com\" target=\"_blank\">星宇博客</a></div></div>\n<!--后台公告结束-->'),('bzj','0'),('dswz','ds.xingyupay.com');
/*!40000 ALTER TABLE `sup_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sup_pay`
--

DROP TABLE IF EXISTS `sup_pay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sup_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime DEFAULT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `name` text NOT NULL,
  `sup` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1691 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sup_pay`
--

LOCK TABLES `sup_pay` WRITE;
/*!40000 ALTER TABLE `sup_pay` DISABLE KEYS */;
/*!40000 ALTER TABLE `sup_pay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sup_tx`
--

DROP TABLE IF EXISTS `sup_tx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sup_tx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` float DEFAULT NULL,
  `realmoney` float DEFAULT NULL,
  `pay_type` int(11) DEFAULT '0',
  `pay_account` text,
  `pay_name` text,
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `user` text,
  `rmb` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sup_tx`
--

LOCK TABLES `sup_tx` WRITE;
/*!40000 ALTER TABLE `sup_tx` DISABLE KEYS */;
/*!40000 ALTER TABLE `sup_tx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `pwd` text NOT NULL,
  `qq` bigint(20) NOT NULL,
  `wx` text NOT NULL,
  `rmb` float DEFAULT '0',
  `pay_name` text,
  `pay_type` int(3) NOT NULL DEFAULT '0',
  `pay_account` text,
  `tixian_rate` int(11) NOT NULL DEFAULT '5',
  `tixian_min` int(11) NOT NULL DEFAULT '10',
  `status` int(11) NOT NULL DEFAULT '0',
  `margin` float NOT NULL DEFAULT '0',
  `adtime` datetime DEFAULT NULL,
  `email` text NOT NULL,
  `key` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'admin','$2y$10$5V7GCgwxinMy62J6a66HwOkuu/HDa78dactBasCsLePIJGAj7ouwm',2984446297,'',0,'',0,'',5,10,0,0,NULL,'','');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-03  1:12:11
