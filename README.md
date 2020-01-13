# Henkan

**Henkan** (meaning _conversion_ or _transformation_ in Japanese) converts a short piece of text from any one of ***4 formats***:

 1) Source Template Format
 2) URL
 3) HTML Attribute Value
 4) Text Copy

to any of the other formats.

The output of any of these conversions can also be influenced by modification of two optional parameters:

 - `$Style` : `'henkan'` | `raw`
 - `$Case` : `'henkan'` | `raw`  

**Henkan** is a fundamental building block of the **Ashiva CMS** in that it allows _different (but translatable)_ versions of the same core string to be used in:

 - Data Keys
 - URL Paths
 - HTML Attributes
 - CSS Classes
 - The plain text content of Headings, Menu Items etc.

**Henkan** was originally written in **PHP** but has proven so useful, it has since been rewritten in **javascript** and may, in future, be rewritten in other languages, libraries or frameworks, including:

 - Node.js
 - jQuery
