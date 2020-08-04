'use strict';
module.exports = (sequelize, DataTypes) => {
  const TaxInvoice = sequelize.define('TaxInvoice', {
    payment_id: DataTypes.INTEGER,
    order_id: DataTypes.INTEGER,
    address_1: DataTypes.STRING,
    address_2: DataTypes.STRING,
    city: DataTypes.STRING,
    state: DataTypes.STRING,
    country: DataTypes.STRING,
    postal_code: DataTypes.STRING
  }, {
    underscored: true,
  });
  TaxInvoice.associate = function(models) {
    // associations can be defined here
  };
  return TaxInvoice;
};