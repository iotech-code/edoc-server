'use strict';

var bcrypt = require('bcrypt')

module.exports = {
  up: (queryInterface, Sequelize) => {
    /*
      Add altering commands here.
      Return a promise to correctly handle asynchronicity.

      Example:
    */
      return queryInterface.bulkInsert('Users', [{
        role_id: 1,
        email: 'tester@iotech.co.th',
        password: bcrypt.hashSync('123456', 10),
        first_name: 'first',
        last_name: 'last',
        birth_date: '1995-3-20',
        school_id: 1,
        grade_id: 1,
        created_at: new Date(),
        updated_at: new Date(),
      }], {});
  },

  down: (queryInterface, Sequelize) => {
    /*
      Add reverting commands here.
      Return a promise to correctly handle asynchronicity.

      Example:
      return queryInterface.bulkDelete('People', null, {});
    */
  }
};
