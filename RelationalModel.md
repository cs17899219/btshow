# 介绍 #
以话题(topic)为核心的模型关系

# 关系术语 #
  * 有一个: 多对一，可空
  * 必须有一个: 多对一,非空
  * 属于: 多对一,可空
  * 必须属于: 多对一,非空
  * 包含多个: 一对多

# 内容 #

## 注册会员 ##
  * 注册会员 属于 组

## 组(team) ##
  * 组 有一个 组所有者
  * 组 包含多个 注册会员

## 番(bangumi) ##
  * 

## 话题(topic) ##
  * 话题(topic) 属于 字幕组(team) 且 属于 发布者(user) 且 属于 番(bangumi)
  * 话题(topic) 包含多个 bt资源(btdata)
  * 话题(topic) 包含多个 em资源(emdata)