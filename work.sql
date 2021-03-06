-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-04-10 16:28:38
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `work`
--

-- --------------------------------------------------------

--
-- 表的结构 `w_integral_products`
--

CREATE TABLE IF NOT EXISTS `w_integral_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `logo` varchar(300) NOT NULL COMMENT '抽奖图标',
  `nums` int(11) NOT NULL,
  `integral` int(11) NOT NULL,
  `prob` decimal(8,3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `w_integral_products`
--

INSERT INTO `w_integral_products` (`id`, `name`, `logo`, `nums`, `integral`, `prob`) VALUES
(1, '10元话费充值卡', '/work_log/Public/worklog/lucky/images/jp1.png', 5, 200, '50.000'),
(2, '20元现金兑换劵', '/work_log/Public/worklog/lucky/images/jp4.png', 10, 400, '20.000'),
(4, '50元话费充值卡', '/work_log/Public/worklog/lucky/images/jp9.png', 8, 800, '10.000'),
(5, '100元中国石化加油卡', '/work_log/Public/worklog/lucky/images/jp2.png', 10, 1600, '0.100'),
(6, '200元超市购物劵', '/work_log/Public/worklog/lucky/images/jp6.png', 10, 3800, '0.100'),
(7, '300元现金兑换劵', '/work_log/Public/worklog/lucky/images/jp5.png', 10, 3900, '0.100'),
(8, '600元学费抵用劵', '/work_log/Public/worklog/lucky/images/jp7.png', 9, 8000, '1.000'),
(9, '1000元现金兑换劵', '/work_log/Public/worklog/lucky/images/jp10.png', 10, 20000, '0.010'),
(10, '800元现金卷', '/work_log/Public/worklog/lucky/images/jp.png', 10, 17000, '0.020'),
(11, '1000元学费抵用卷', '/work_log/Public/worklog/lucky/images/jp3.png', 10, 13000, '0.010'),
(12, '2000元学费抵用卷', '/work_log/Public/worklog/lucky/images/jp11.png', 10, 25000, '0.200');

-- --------------------------------------------------------

--
-- 表的结构 `w_integral_sign`
--

CREATE TABLE IF NOT EXISTS `w_integral_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `integral` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `w_integral_sign`
--

INSERT INTO `w_integral_sign` (`id`, `mid`, `integral`, `addtime`, `year`, `month`, `day`) VALUES
(1, 1, 1, 1457225169, 2016, 3, 6),
(2, 1, 1, 1457052369, 2016, 3, 4),
(3, 1, 1, 1456965969, 2016, 3, 3),
(4, 1, 1, 1456879569, 2016, 3, 2),
(5, 1, 1, 1456793169, 2016, 3, 1),
(6, 1, 1, 1457138769, 2016, 3, 5),
(15, 1, 2, 1457321718, 2016, 3, 7),
(16, 1, 2, 1457422265, 2016, 3, 8),
(26, 1, 1, 1458540930, 2016, 3, 21),
(22, 1, 1, 1457581130, 2016, 3, 10),
(24, 1, 1, 1458108275, 2016, 3, 16);

-- --------------------------------------------------------

--
-- 表的结构 `w_logs`
--

CREATE TABLE IF NOT EXISTS `w_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(3) NOT NULL COMMENT '项目分类ID',
  `content` text NOT NULL,
  `details` text NOT NULL COMMENT '详细',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1功能/2BUG',
  `finished` tinyint(1) NOT NULL,
  `difficulty` tinyint(4) NOT NULL COMMENT '难度系数',
  `finish_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `day` int(2) NOT NULL,
  `delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf32 AUTO_INCREMENT=254 ;

--
-- 转存表中的数据 `w_logs`
--

INSERT INTO `w_logs` (`id`, `pid`, `content`, `details`, `type`, `finished`, `difficulty`, `finish_time`, `create_time`, `year`, `month`, `day`, `delete`) VALUES
(36, 0, '微广官网后台款式和库存相对应', '', 1, 1, 0, 1452561064, 1452561064, 2016, 1, 12, 0),
(35, 0, '微广官网产品详情页价格跟款式的变动', '', 1, 1, 0, 1452560969, 1452560969, 2016, 1, 12, 0),
(34, 2, 'Lazyload.js的使用（创惠云购首页）', '', 1, 1, 0, 1452560902, 1452560902, 2016, 1, 12, 0),
(33, 2, '创惠云购搜索栏样式', '', 1, 1, 0, 1452560850, 1452560850, 2016, 1, 12, 0),
(37, 2, '创惠BANNER高度定死并更换BANNER图片', '', 1, 1, 0, 1452580882, 1452580882, 2016, 1, 12, 0),
(38, 2, '创惠底部屏幕宽度变化时出错', '', 1, 1, 0, 1452580925, 1452580925, 2016, 1, 12, 0),
(39, 3, '豆芽建议献策模块', '', 1, 1, 0, 1452738602, 1452738602, 2016, 1, 14, 0),
(40, 3, '豆芽帮上有名', '', 1, 1, 0, 1452846186, 1452738666, 2016, 1, 14, 0),
(41, 11, '日志本添加完成日期显示', '', 1, 1, 0, 1452738688, 1452738688, 2016, 1, 14, 0),
(42, 11, '日志本点击日期3D转化', '', 1, 0, 0, 0, 1452762754, 2016, 1, 14, 1),
(43, 11, '日志本日历模板', '', 1, 1, 0, 1453788333, 1452762878, 2016, 1, 14, 0),
(44, 11, '日志本完成和未完成的筛选操作', '', 1, 1, 0, 1453190709, 1452762909, 2016, 1, 14, 0),
(45, 11, '日志删除功能', '', 1, 1, 0, 1452844651, 1452819492, 2016, 1, 15, 0),
(46, 4, '麦豆下单价格显示跟会员相对应', '', 1, 1, 0, 1453099284, 1453086538, 2016, 1, 18, 0),
(47, 4, '麦豆非会员推广二维码不绑定关系', '', 1, 1, 0, 1453099273, 1453086717, 2016, 1, 18, 0),
(48, 11, '日志显示完成未完成总数 三个数', '', 1, 1, 0, 1453180455, 1453087078, 2016, 1, 18, 0),
(49, 11, '日志完成时加载 和数量变化', '', 1, 1, 0, 1453191918, 1453087123, 2016, 1, 18, 0),
(50, 4, '麦豆后台设置会员等级', '', 1, 1, 0, 1453097894, 1453097870, 2016, 1, 18, 0),
(51, 4, '麦豆返佣操作', '', 1, 1, 0, 1453102826, 1453099445, 2016, 1, 18, 0),
(52, 11, '日志滑动', '', 1, 1, 0, 1453182533, 1453103701, 2016, 1, 18, 0),
(64, 0, '旧版本BOX的使用', '', 1, 1, 2, 1456822716, 1453439818, 2016, 1, 22, 0),
(65, 2, '创惠云购的测试 充值 升级 购物  款式 退款', '', 1, 1, 1, 1453691879, 1453439841, 2016, 1, 22, 0),
(66, 18, '王的商城首页PRODUCTS的catid的设置', '', 1, 1, 1, 1453682127, 1453445404, 2016, 1, 22, 0),
(73, 2, '创惠云购等级LOGO', '', 1, 1, 1, 1453699262, 1453682156, 2016, 1, 25, 0),
(75, 2, '创惠云购升级按钮不明显', '', 1, 1, 1, 1453699266, 1453682182, 2016, 1, 25, 0),
(76, 2, '创惠云购我的分店里佣金提现，余额提现加背景色', '', 1, 1, 1, 1453704796, 1453682308, 2016, 1, 25, 0),
(77, 2, '创惠云购我的佣金里新增 辅助奖金 一项', '', 1, 1, 1, 1453700095, 1453682349, 2016, 1, 25, 0),
(78, 2, '创惠云购分类图标和广告 广告超链接', '', 1, 1, 1, 1453708078, 1453688295, 2016, 1, 25, 0),
(80, 11, '日志添加本身添加项目分类', '', 1, 1, 1, 1456822730, 1453688379, 2016, 1, 25, 0),
(81, 2, '创惠云购提现标注 扣除5%手续费', '', 1, 1, 1, 1453779729, 1453699321, 2016, 1, 25, 0),
(82, 11, '日志添加搜索功能', '', 1, 1, 1, 1454307166, 1453700141, 2016, 1, 25, 0),
(83, 2, '创惠提现分支付宝和银行卡后台相对应显示', '', 1, 1, 2, 1453778389, 1453776908, 2016, 1, 26, 0),
(84, 2, '创惠云购后台提现显示应付多少金额还有前台提现列表', '', 1, 1, 2, 1453778386, 1453776968, 2016, 1, 26, 0),
(85, 2, '创惠云购首页图片', '', 1, 1, 1, 1453786951, 1453777001, 2016, 1, 26, 0),
(86, 2, '创惠云购充值增值币显示金额，提示增值币', '', 1, 1, 2, 1453779717, 1453777053, 2016, 1, 26, 0),
(87, 11, '日志点击第二个完成时绿色勾没效果', '', 1, 1, 1, 1454317507, 1453778444, 2016, 1, 26, 0),
(88, 11, '日志新增项目分类', '', 1, 1, 1, 1455507530, 1453794894, 2016, 1, 26, 0),
(94, 2, '创惠后台添加权限', '', 1, 1, 1, 1453883060, 1453859655, 2016, 1, 27, 0),
(93, 2, '创惠BUG修复', '', 1, 1, 1, 1453883051, 1453859598, 2016, 1, 27, 0),
(92, 11, '日志用CSS实现滑动', '', 1, 0, 1, 0, 1453795011, 2016, 1, 26, 0),
(98, 2, '创惠首页加载动画', '', 1, 1, 2, 1454307081, 1453882532, 2016, 1, 27, 0),
(99, 2, '创惠品牌管理', '', 1, 1, 2, 1453886275, 1453882556, 2016, 1, 27, 0),
(100, 2, '创惠会员列表删除需要输入密码', '', 1, 1, 2, 1454051598, 1453882570, 2016, 1, 27, 0),
(101, 2, '创惠管理员升级记录', '', 1, 1, 1, 1453973317, 1453884470, 2016, 1, 27, 0),
(105, 2, '创惠管理员设置会员', '', 1, 1, 1, 1453946495, 1453946491, 2016, 1, 28, 0),
(107, 2, '创惠充值BUG', '', 1, 1, 3, 1453969230, 1453949654, 2016, 1, 28, 0),
(126, 4, '麦豆测试3', '', 1, 0, 1, 0, 1454311962, 2016, 2, 1, 1),
(127, 3, '豆芽测试4', '', 1, 0, 1, 0, 1454312164, 2016, 2, 1, 1),
(112, 2, '创惠二维码页面', '', 1, 1, 1, 1453969733, 1453969247, 2016, 1, 28, 0),
(113, 2, '创惠totalPay错误', '', 1, 1, 1, 1454047991, 1453974900, 2016, 1, 28, 0),
(114, 4, '麦豆新返佣操作', '', 1, 1, 1, 1454294581, 1454124887, 2016, 1, 30, 0),
(115, 4, '麦豆新后台设置会员等级', '', 1, 1, 1, 1454294578, 1454124963, 2016, 1, 30, 0),
(116, 11, '日志智能添加项目', '', 1, 1, 1, 1454317501, 1454125247, 2016, 1, 30, 0),
(117, 4, '麦豆后台产品规格SET_NEW', '', 1, 1, 1, 1454294573, 1454219241, 2016, 1, 31, 0),
(118, 4, '麦豆提现 加银行卡,列表中加 审核', '', 1, 1, 1, 1454294575, 1454220688, 2016, 1, 31, 0),
(119, 4, '麦豆申请代理功能', '', 1, 1, 1, 1454294614, 1454294612, 2016, 2, 1, 0),
(120, 2, '创惠充值升级统计，商品统计', '', 1, 1, 1, 1454307084, 1454306426, 2016, 2, 1, 0),
(121, 0, '啊啊啊啊啊啊', '', 1, 0, 1, 0, 1454308119, 2016, 2, 1, 1),
(122, 0, '的发的发的发的发的发的发的发的发的发的发的发的发的发的发', '', 1, 0, 1, 0, 1454308212, 2016, 2, 1, 1),
(123, 4, '麦豆测试', '', 1, 0, 1, 0, 1454310510, 2016, 2, 1, 1),
(125, 4, '麦豆测试2', '', 1, 0, 1, 0, 1454310596, 2016, 2, 1, 1),
(128, 6, '测试项目一', '', 1, 0, 1, 0, 1454315143, 2016, 2, 1, 1),
(129, 7, '测试项目二', '', 1, 0, 1, 0, 1454315438, 2016, 2, 1, 1),
(130, 9, '测试项目三', '', 1, 0, 1, 0, 1454315586, 2016, 2, 1, 1),
(131, 9, '测试项目四', '', 1, 0, 1, 0, 1454315598, 2016, 2, 1, 1),
(132, 8, '测试项目五', '', 1, 0, 1, 0, 1454315699, 2016, 2, 1, 1),
(133, 9, '测试项目六', '', 1, 0, 1, 0, 1454315835, 2016, 2, 1, 1),
(134, 10, '测试项目七', '', 1, 0, 1, 0, 1454316181, 2016, 2, 1, 1),
(135, 11, '日志添加随摘功能', '', 1, 1, 2, 1456274517, 1455517323, 2016, 2, 15, 0),
(136, 12, '人人顶部搜索功能（模糊化）', '', 1, 1, 2, 1456129440, 1455786144, 2016, 2, 18, 0),
(137, 12, '人人右侧BAR', '', 1, 1, 1, 1456129438, 1455786167, 2016, 2, 18, 0),
(138, 12, '人人签到功能', '', 1, 1, 1, 1456129476, 1456129456, 2016, 2, 22, 0),
(139, 12, '人人抽奖功能', '', 1, 1, 1, 1456129478, 1456129470, 2016, 2, 22, 0),
(140, 13, 'HTML5模块的拖动测试', '', 1, 1, 1, 1456822737, 1456194847, 2016, 2, 23, 0),
(141, 11, '日志添加统计功能（图标形式，新页面）', '', 1, 1, 3, 1456380189, 1456273975, 2016, 2, 24, 0),
(142, 11, '日志添加一块可拖动的浮动模块', '', 1, 1, 3, 1456300407, 1456274025, 2016, 2, 24, 0),
(148, 11, '日志关于加载动画的封装', '', 1, 0, 3, 0, 1456382036, 2016, 2, 25, 0),
(144, 0, '修改gridly插件', '', 1, 1, 2, 1456380207, 1456366309, 2016, 2, 25, 0),
(145, 11, '日志的随摘功能改为纯文字，案例做另一个页面', '', 1, 0, 2, 0, 1456366860, 2016, 2, 25, 0),
(149, 12, '人人积分购物', '', 1, 1, 2, 1456387187, 1456382059, 2016, 2, 25, 0),
(161, 0, '啊啊啊', '', 1, 0, 1, 0, 1456390037, 2016, 2, 25, 1),
(162, 12, '人人后台相关展示和设置', '', 1, 1, 2, 1456792482, 1456792478, 2016, 3, 1, 0),
(163, 13, '测试加载动画1', '', 1, 1, 1, 1456793110, 1456793106, 2016, 3, 1, 0),
(164, 11, '日志优化性能（第一次）', '', 1, 1, 1, 1458022374, 1456793231, 2016, 3, 1, 0),
(165, 11, '日志添加项目描述', '', 1, 1, 3, 1456822592, 1456794190, 2016, 3, 1, 0),
(166, 12, '人人会员中心套模板', '', 1, 1, 1, 1457080409, 1456885330, 2016, 3, 2, 0),
(167, 12, '人人浏览记录页面套模板', '', 1, 1, 1, 1457080411, 1456895287, 2016, 3, 2, 0),
(168, 12, '人人我的订单套模板', '', 1, 1, 1, 1457080412, 1456898822, 2016, 3, 2, 0),
(169, 12, '人人我的小店套模板', '', 1, 1, 1, 1457080414, 1456901764, 2016, 3, 2, 0),
(170, 12, '人人购物车套模板', '', 1, 1, 1, 1457080416, 1456902774, 2016, 3, 2, 0),
(171, 12, '人人会员注册和信息修改', '', 1, 1, 1, 1457080417, 1456966625, 2016, 3, 3, 0),
(172, 12, '人人我的团队页面', '', 1, 1, 1, 1457080418, 1456972742, 2016, 3, 3, 0),
(173, 12, '人人佣金列表页面', '', 1, 1, 1, 1457080420, 1456982627, 2016, 3, 3, 0),
(174, 12, '人人抽奖前后台排序智能化', '', 1, 1, 2, 1457080421, 1457056974, 2016, 3, 4, 0),
(175, 12, '人人兑换商品页面（前后台）', '', 1, 1, 2, 1457080423, 1457073782, 2016, 3, 4, 0),
(176, 14, '人人我的奖品页面', '', 1, 1, 1, 1457080424, 1457075464, 2016, 3, 4, 0),
(177, 12, '人人我的余额页面套现', '', 1, 1, 1, 1457080425, 1457077879, 2016, 3, 4, 0),
(178, 12, '人人签到页面', '', 1, 1, 1, 1457322413, 1457080303, 2016, 3, 4, 0),
(179, 11, '日志系统中日历选择当天内容显示出错', '', 1, 1, 1, 1458023045, 1457080398, 2016, 3, 4, 0),
(180, 12, '人人积分页面', '', 1, 1, 1, 1457332902, 1457322433, 2016, 3, 7, 0),
(181, 12, '人人已有奖品列表页', '', 1, 1, 1, 1457397247, 1457322459, 2016, 3, 7, 0),
(182, 12, '人人后台素材管理', '', 1, 1, 1, 1457407775, 1457339873, 2016, 3, 7, 0),
(183, 12, '人人分销中心页面', '', 1, 1, 1, 1457407774, 1457397682, 2016, 3, 8, 0),
(184, 12, '人人项目描述', '', 1, 1, 2, 1459908436, 1457399812, 2016, 3, 8, 0),
(185, 12, '人人公众号菜单栏设置', '', 1, 1, 1, 1457427842, 1457401349, 2016, 3, 8, 0),
(186, 12, '人人页面与功能测试', '', 1, 1, 1, 1459908432, 1457407794, 2016, 3, 8, 0),
(187, 12, '人人后台奖品审核功能', '', 1, 1, 1, 1457491051, 1457427827, 2016, 3, 8, 0),
(188, 12, '人人签到顶部日期不居中，连续签到算上今天', '', 1, 1, 1, 1457492921, 1457487502, 2016, 3, 9, 0),
(189, 12, '人人搜索历史过滤重复字段', '', 1, 1, 1, 1457492923, 1457491906, 2016, 3, 9, 0),
(190, 11, '日志项目描述用css实现滑动', '', 1, 0, 1, 0, 1457495050, 2016, 3, 9, 0),
(191, 12, '人人注册审核功能，绑定和推广绑定送积分，后台积分消费情况', '', 1, 1, 1, 1457661636, 1457595862, 2016, 3, 10, 0),
(192, 12, '人人抽奖BUG 谢谢惠顾是500元现金卷', '', 1, 1, 1, 1457743000, 1457684177, 2016, 3, 11, 0),
(193, 12, '人人积分英雄榜页面', '', 1, 1, 1, 1457747712, 1457743017, 2016, 3, 12, 0),
(194, 12, '人人购物积分根据商品分开设置', '', 1, 1, 1, 1457767363, 1457764416, 2016, 3, 12, 0),
(195, 15, '封装WEBUI的样式（整成JS）', '', 1, 0, 1, 0, 1458005888, 2016, 3, 15, 0),
(196, 0, '将人人中抽奖，签到，上传店铺图片提取出来', '', 1, 0, 1, 0, 1458009973, 2016, 3, 15, 0),
(197, 11, '日志点击完成的日志的时候显示创建日期和完成日期', '', 1, 0, 1, 0, 1458022493, 2016, 3, 15, 0),
(198, 11, '日志分BUG处理和功能创建两个模块', '', 1, 1, 1, 1460162443, 1458022527, 2016, 3, 15, 0),
(199, 11, '日志右上角数字过大移到其它位置显示', '', 1, 0, 1, 0, 1458022553, 2016, 3, 15, 1),
(200, 2, '创惠订单可修改下单人，电话，地址', '', 1, 1, 1, 1458093318, 1458032953, 2016, 3, 15, 0),
(201, 2, '创惠佣金提现记录可修改姓名，开户行，银行卡号，支付宝', '', 1, 1, 1, 1458097845, 1458033064, 2016, 3, 15, 0),
(202, 12, '人人新增自学考试等文章添加', '', 1, 1, 1, 1458525107, 1458191684, 2016, 3, 17, 0),
(203, 11, '日志项目智能添加错误', '', 1, 1, 1, 1458525779, 1458191772, 2016, 3, 17, 0),
(204, 12, '人人首页购物车直接购买', '', 1, 1, 2, 1458520917, 1458519694, 2016, 3, 21, 0),
(205, 12, '人人首页BANNER加载时候撑出', '', 1, 1, 1, 1458524371, 1458520955, 2016, 3, 21, 0),
(209, 17, '嗨云购物地址页面套模板', '', 1, 1, 1, 1458624477, 1458611118, 2016, 3, 22, 0),
(210, 17, '嗨云地址列表页面', '', 1, 1, 1, 1458635138, 1458625108, 2016, 3, 22, 0),
(211, 11, '日志动态添加的项目不能点击', '', 2, 1, 1, 1460162440, 1458625158, 2016, 3, 22, 0),
(212, 17, '嗨云个人中心页面', '', 1, 1, 1, 1458636738, 1458635507, 2016, 3, 22, 0),
(213, 17, '嗨云我的订单页面', '', 1, 1, 1, 1458704039, 1458636753, 2016, 3, 22, 0),
(214, 17, '嗨云店铺昵称电话设置', '', 1, 0, 1, 0, 1458636940, 2016, 3, 22, 1),
(215, 17, '嗨云我的收藏页面', '', 1, 1, 1, 1458718731, 1458714185, 2016, 3, 23, 0),
(216, 17, '嗨云浏览记录页面', '', 1, 1, 1, 1458723004, 1458719535, 2016, 3, 23, 0),
(217, 11, '日志添加新的日志之后项目描述打不开', '', 2, 1, 1, 1460162439, 1458719563, 2016, 3, 23, 0),
(218, 17, '嗨云商家中心页面', '', 1, 1, 1, 1458790008, 1458724136, 2016, 3, 23, 0),
(219, 17, '嗨云累计收益页面', '', 1, 1, 1, 1458801551, 1458790025, 2016, 3, 24, 0),
(220, 18, '王的商城后台商品搜索功能，前台下单填写身份证和相关地方的显示', '', 1, 0, 1, 0, 1458790081, 2016, 3, 24, 0),
(221, 17, '嗨云提现列表页面', '', 1, 0, 1, 0, 1458801566, 2016, 3, 24, 0),
(222, 0, '我的团队列表', '', 1, 1, 1, 1458805632, 1458802678, 2016, 3, 24, 0),
(223, 17, '嗨云更多特卖页面', '', 1, 1, 3, 1458956535, 1458808035, 2016, 3, 24, 0),
(224, 17, '嗨云每日精选页面', '', 1, 1, 1, 1458977421, 1458957078, 2016, 3, 26, 0),
(225, 11, '日志可修改', '', 1, 0, 1, 0, 1458962938, 2016, 3, 26, 0),
(226, 17, '嗨云品牌馆页面', '', 1, 1, 1, 1458982496, 1458977439, 2016, 3, 26, 0),
(227, 17, '嗨云后台每日必备，今日特卖，热卖抢购，品牌馆', '', 1, 1, 1, 1458977486, 1458977484, 2016, 3, 26, 0),
(228, 12, '人人学苑购物车和立即购买分开支付', '', 1, 1, 2, 1459212201, 1459212197, 2016, 3, 29, 0),
(229, 12, '人人学苑商品列表页，顶部排序', '', 1, 1, 1, 1459214297, 1459212239, 2016, 3, 29, 0),
(230, 0, '每日签到、积分抽奖、积分兑换非会员可以查看不能操作', '', 1, 1, 1, 1459215740, 1459214338, 2016, 3, 29, 0),
(231, 12, '人人学苑兑换奖品不适用默认的CONFIRM', '', 1, 1, 1, 1459216463, 1459216461, 2016, 3, 29, 0),
(232, 12, '人人学苑我的推广二维码页面', '', 1, 1, 1, 1459218492, 1459218490, 2016, 3, 29, 0),
(233, 12, '人人学苑第二次修改测试', '', 1, 1, 1, 1459229931, 1459218645, 2016, 3, 29, 0),
(234, 12, '人人学苑产品列表页  购物车功能', '', 1, 1, 1, 1459229929, 1459219293, 2016, 3, 29, 0),
(235, 12, '人人学苑添加地址模块', '', 1, 1, 1, 1459309334, 1459230508, 2016, 3, 29, 0),
(236, 17, '嗨云商品详情页购物功能的初步封装', '', 1, 1, 1, 1459322369, 1459309351, 2016, 3, 30, 0),
(237, 17, '嗨云店铺统计页面', '', 1, 1, 1, 1459826884, 1459414000, 2016, 3, 31, 0),
(238, 17, '嗨云扫推广二维码推送图文功能', '', 1, 1, 1, 1459911434, 1459414030, 2016, 3, 31, 0),
(239, 17, '嗨云商品二维码功能', '', 1, 1, 1, 1459908205, 1459414041, 2016, 3, 31, 0),
(240, 17, '嗨云购物车页面', '', 1, 1, 1, 1459991514, 1459912012, 2016, 4, 6, 0),
(241, 17, '嗨云注册页面', '', 1, 1, 1, 1459927735, 1459912022, 2016, 4, 6, 0),
(242, 2, '创惠云购快速购买功能', '', 1, 1, 1, 1460086621, 1459928382, 2016, 4, 6, 0),
(243, 17, '嗨云快速购买功能', '', 1, 1, 1, 1459996663, 1459928394, 2016, 4, 6, 0),
(244, 17, '嗨云下单结算页面', '', 1, 1, 1, 1459991511, 1459930791, 2016, 4, 6, 0),
(245, 0, '关于toggle的使用', '', 1, 0, 1, 0, 1459935541, 2016, 4, 6, 0),
(246, 0, '支付宝2.0的应用 在嗨云Extend中alipay.php和Store中的test()方法', '', 1, 0, 3, 0, 1460021150, 2016, 4, 7, 0),
(247, 0, '建立局域网工作站', '', 1, 1, 2, 1460164159, 1460162404, 2016, 4, 9, 0),
(248, 11, '日志生成其他分类项目', '', 1, 0, 1, 0, 1460162433, 2016, 4, 9, 0),
(249, 19, '零距离后台充值水票管理TicketsAction', '', 1, 1, 1, 1460188742, 1460164469, 2016, 4, 9, 0),
(250, 17, '嗨云账单页面', '', 1, 1, 1, 1460167380, 1460167377, 2016, 4, 9, 0),
(251, 19, '零距离直营店列表页面', '', 1, 0, 1, 0, 1460188805, 2016, 4, 9, 0),
(252, 11, '日志添加时候有时候弹出两次确认框', '', 2, 0, 1, 0, 1460188831, 2016, 4, 9, 0),
(253, 11, '日志系统数据表单独提出', '', 1, 0, 1, 0, 1460297555, 2016, 4, 10, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_project_class`
--

CREATE TABLE IF NOT EXISTS `w_project_class` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `logo` varchar(120) NOT NULL COMMENT '图标',
  `nums` int(3) NOT NULL COMMENT '日志数量',
  `time` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `delete` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf32 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `w_project_class`
--

INSERT INTO `w_project_class` (`id`, `name`, `logo`, `nums`, `time`, `year`, `month`, `day`, `delete`) VALUES
(18, '王的', '', 1, 1458790081, 2016, 3, 24, 0),
(2, '创惠云购', '', 29, 1454309962, 2016, 2, 1, 0),
(3, '豆芽', '', 2, 1454309962, 2016, 2, 1, 0),
(4, '麦豆', '', 11, 1454310510, 2016, 2, 1, 0),
(17, '嗨云', '', 21, 1458625108, 2016, 3, 22, 0),
(12, '人人', '', 41, 1455786167, 2016, 2, 18, 0),
(11, '日志', '', 31, 1455517323, 2016, 2, 15, 0),
(13, '测试', '', 1, 1456793106, 2016, 3, 1, 0),
(15, '封装', '', 1, 1458005888, 2016, 3, 15, 0),
(19, '零距', '', 1, 1460188805, 2016, 4, 9, 0);

-- --------------------------------------------------------

--
-- 表的结构 `w_project_describe`
--

CREATE TABLE IF NOT EXISTS `w_project_describe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(4) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf32 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `w_project_describe`
--

INSERT INTO `w_project_describe` (`id`, `pid`, `content`) VALUES
(1, 11, '日志系统描述：\n1：'),
(2, 12, '台州人人学苑\n功能描述：\n1：三级分销功能，扫码绑定FID ,SID,TID,BINDMID\n2：积分系统：\n系统描述：\n积分来源：①绑定微信账号送10积分；②推广邀请他人成功绑定送10积分；③每日签到送1积分；④购买产品送积分，具体额度在管理端设置。\n注：在管理后台可以查看到任意会员的积分增加、消费记录。\n推广送积分是根据bindmid送的\n抽奖概率算法：根据从小到大依次抽奖\n后台设置奖品：智能填充谢谢惠顾，乱序排列，智能判断奖品个数最大个数为11；\n购物送积分：根据商品单独设置\n消费：\n抽奖（100积分），兑换奖品【抽奖跟兑换的奖品不一致，后台可设置】\n兑换奖品一天一次\n我的团队只显示下一级\n\n数据表\n①integral_products（奖品列表）\n②integral_winner（中奖列表）③Distribution_myprize（奖品发放列表）\n④integral_luck（抽奖列表：抽奖次数和使用积分情况）\n⑤integral_record（积分记录表[增/减]）\n⑥Integral_shopping（积分兑换记录）\n⑦product_browse_record（产品浏览记录）\n⑧integral_sign（签到记录表）\n⑨integral_set（部分素材超链接【英雄榜/思路】）\n⑩material_list（素材表）\n⑴Distribution_myprize（奖品发放表包括抽奖和兑换）\n⑵article_list(文章列表)\nBASE中\n1：integral_record（积分记录[增/减]）Ⅰ\n涉及表：⑤\n2：returnymd（返回年月日加10位随机编号）Ⅱ\n\nWAP/STORE中\n公共函数：如果没有注册且页面是lucky和exchange时候会跳转到注册页面\n\n1：抽奖功能：lucky\n抽奖算法：从概率小的开始抽分两种：\n⒈大于1的 例30%   ，从1到100随机\n⒉小雨1的 例0.2%，从1到500随机 抽中1为中奖\n涉及到的表：①，②，③，④\n涉及到的外部函数：Ⅰ，Ⅱ\n\n2：兑换功能 ：exchange\n涉及到的表：⑥\n涉及到的外部函数：Ⅰ，Ⅱ\n\n3：删除搜索历史：historyAjax\n搜索历史保存在SESSION中（保存方法写在productszhong ）:serialize/unserialize(session(''history''))\n\n4：赚页面：integral_make\n\nWAP/DISTRIBUTION\n1：个人信息编辑：memberEdit\n就修改密码\n\n2：注册：register\n填写tele,email,password在distribution_member中\n\n3：浏览记录：bowseRecord\n涉及到的表：⑦\n\n4：签到（显示：sign；AJAX：memberSign）\n连续7天签到一天2积分\n涉及到的表：⑧\n涉及到的外部函数：Ⅰ\n\n5：我的小店（分销中心）：myshop\n涉及到的表：⑨，⑩\n\n6：我的积分：myIntegral\n涉及到的表：⑤\n\n7：店铺设置：shopEdit\nLOGO一周只能修改一次，店铺名不能重复\n\n8：我的奖品页面：myprize\n涉及到的表：⑴'),
(4, 17, '嗨云系统描述：\n地址通过数据库保存，修改删除和选择哪一个地址，类似淘宝\n数据表：(新增)\n⑴pigcms_address_list(地址表)\n⑵distribution_myprize(我的红包)\n⑶integral_product(红包)\n⑷product_browse_record(产品浏览记录)\n⑸product_snapup(今日特卖)\n⑹product_brand(品牌列表)\n⑺distribution_visit(访问记录表)\n⑻distribution_visitcount(每日访问数量)\n\n系统描述：\n1.扫码之后绑定bindmid和fid再扫码其他二维码时不能再绑定\n2.判断会员用distritime 注册之后赋值（payHandle）');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
