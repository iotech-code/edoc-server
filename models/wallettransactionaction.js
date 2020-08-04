'use strict';
module.exports = (sequelize, DataTypes) => {
  const WalletTransactionAction = sequelize.define('WalletTransactionAction', {
    name: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  WalletTransactionAction.associate = function(models) {
    // associations can be defined here
  };
  return WalletTransactionAction;
};