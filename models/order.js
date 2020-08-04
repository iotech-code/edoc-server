'use strict';
module.exports = (sequelize, DataTypes) => {
  const Order = sequelize.define('Order', {
    user_id: DataTypes.INTEGER,
    total_price: DataTypes.DECIMAL,
    status_id: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  Order.associate = function(models) {
    // associations can be defined here
  };
  return Order;
};