'use strict';
module.exports = (sequelize, DataTypes) => {
  const Payment = sequelize.define('Payment', {
    order_id: DataTypes.INTEGER,
    user_id: DataTypes.INTEGER,
    payment_type_id: DataTypes.INTEGER,
    have_tax_invoice: DataTypes.BOOLEAN
  }, {
    underscored: true,
  });
  Payment.associate = function(models) {
    // associations can be defined here
  };
  return Payment;
};