'use strict';
module.exports = (sequelize, DataTypes) => {
  const WalletTransaction = sequelize.define('WalletTransaction', {
    wallet_id: DataTypes.INTEGER,
    before_value: DataTypes.DECIMAL,
    after_value: DataTypes.DECIMAL,
    action_id: DataTypes.INTEGER,
    refer_id: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  WalletTransaction.associate = function(models) {
    // associations can be defined here
  };
  return WalletTransaction;
};