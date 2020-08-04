'use strict';
module.exports = (sequelize, DataTypes) => {
  const OrderStatus = sequelize.define('OrderStatus', {
    name: DataTypes.STRING
  }, {
    underscored: true,
  });
  OrderStatus.associate = function(models) {
    // associations can be defined here
  };
  return OrderStatus;
};