'use strict';
module.exports = (sequelize, DataTypes) => {
  const QuestionType = sequelize.define('QuestionType', {
    name: DataTypes.STRING
  }, {
    underscored: true,
  });
  QuestionType.associate = function(models) {
    // associations can be defined here
  };
  return QuestionType;
};