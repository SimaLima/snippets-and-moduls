// OBJECTS: PROPERTIES AND METHODS


// defining object with some properties and methods
var person = {
    firstName: 'Simun',
    lastName: 'Ivanac',
    age: 24,
    fullName: function() {
        return this.firstName + ' ' + this.lastName;
    }
};


// changing values:
// objectName.property || objectName['property']
person.age = 25;


// add property
person.nationality = 'Croatian';


// delete property
delete person.age;


// accessing methods
// objectName.methodName()
person.fullName();


// add method to object
person.newMethod = function() {
    return 'I\'m new method';
};
