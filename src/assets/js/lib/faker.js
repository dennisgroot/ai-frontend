// import { faker } from '@faker-js/faker';

// // Function to generate random words
// function generateWords(min, max) {
//     const wordCount = Math.floor(Math.random() * (max - min + 1)) + min;
//     return faker.lorem.words(wordCount);
// }

// // Function to generate random sentences
// function generateSentences(min, max) {
//     const sentenceCount = Math.floor(Math.random() * (max - min + 1)) + min;
//     return faker.lorem.sentences(sentenceCount);
// }

// // Function to generate a random date
// function generateDate() {
//     return faker.date.recent().toLocaleDateString();
// }

// // Select all elements with data-fakerjs attribute
// document.querySelectorAll('[data-fakerjs]').forEach((element) => {
//     const [type, min, max] = element.getAttribute('data-fakerjs').split('|');

//     let generatedText = '';

//     // Check if type is words, sentences, or date and generate appropriate text
//     if (type === 'words') {
//         generatedText = generateWords(parseInt(min), parseInt(max));
//     } else if (type === 'sentences') {
//         generatedText = generateSentences(parseInt(min), parseInt(max));
//     } else if (type === 'date') {
//         generatedText = generateDate();
//     }

//     // Set the generated text as the content of the element
//     element.textContent = generatedText;
// });