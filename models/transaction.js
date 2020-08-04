'use strict';
module.exports = (sequelize, DataTypes) => {
  const Transaction = sequelize.define('Transaction', {
    payment_id: DataTypes.INTEGER,
    provider: DataTypes.INTEGER,
    name: DataTypes.STRING
  }, {
    underscored: true,
  });
  Transaction.associate = function(models) {
    // associations can be defined here
  };
  return Transaction;
};