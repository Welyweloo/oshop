# Routes

| URL | HTTP Method | Controller | Method | Title | Content | Comment |
|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `home` | Dans les shoe | 5 categories | - |
| `/legal-mentions` | `GET`| `MainController` | `legal` | Mentions légales | Boring legal stuff | |
| `/catalog/category/[i:id]` | `GET`| `CatalogController` | `showCategoryProducts` | Category's name | Show all products of one category | [i:id] is the id of the category |
| `/catalog/type/[i:id]` | `GET`| `CatalogController` | `showTypeProducts` | Type's name | Show all products of one type | [i:id] is the type id |
| `/catalog/brand/[i:id]` | `GET`| `CatalogController` | `showBrandProducts` | Brand's name | Show all products of one brand | [i:id] is the brand id |
| `/catalog/product/[i:id]` | `GET`| `CatalogController` | `showProduct` | Product's name | Show all product details | [i:id] is the product id |