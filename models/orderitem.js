'use strict';
module.exports = (sequelize, DataTypes) => {
  const OrderItem = sequelize.define('OrderItem', {
    order_id: DataTypes.INTEGER,
    course_id: DataTypes.INTEGER,
    course_name: DataTypes.STRING,
    price_per_unit: DataTypes.DECIMAL,
    quantity: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  OrderItem.associate = function(models) {
    // associations can be defined here
  };
  return OrderItem;
};