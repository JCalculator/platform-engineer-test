


const Templates = {
  production: 'productionTemplate',
  productionSite: 'productionSiteTemplate',
  emptyProductions: 'emptyProductionsTemplate',
};

const TemplateHtmlCollection = {}

TemplateHtmlCollection[Templates.emptyProductions] = `
<div class="h-full text-3xl text-white pt-5">
  <span class="material-icons text-yellow-400 text-white text-6xl w-full">
    warning
  </span>
  <div class="text-gray-800">
    <p>
      No productions were found!
    </p>
    <p>
      Please try a different date range.
    </p>
  </div>
</div>
`;

TemplateHtmlCollection[Templates.production] = `
<div class="productionCard">
  <div class="titleBox">
    <div class="title">:title:</div>
    <div class="type">:type:</div>
  </div>
  <div class="pl-4 pt-4 font-semibold">
    Shooting Sites
  </div>
  <div class="sites pl-2 pr-2">
    :sites:
  </div>
</div>
`; 
TemplateHtmlCollection[Templates.productionSite] = `
<div class="site">
  <div class="pt-5 name">:name:</div>
  <div class="top-right-badge shoot-date">:shoot_date:</div>
</div>
`;

let Renderers = {};

Renderers[Templates.emptyProductions] = (collection, container) => {
  container.innerHTML = TemplateHtmlCollection[Templates.emptyProductions];
}

Renderers[Templates.productionSite] = (collection) => {

  let siteTemplateHtml = TemplateHtmlCollection[Templates.productionSite];
  let sitesHtmlCollection = []
  collection.forEach(site => {
    sitesHtmlCollection.push(siteTemplateHtml
      .replace(/:name:/g, site.name)
      .replace(/:shoot_date:/g, site.shoot_date));
  });
  return sitesHtmlCollection;
};

Renderers[Templates.production] = (collection, container) => {

  let productionTemplateHtml = TemplateHtmlCollection[Templates.production];
  
  let productionTemplateHtmlCollection = [];

  collection.forEach(production => {
    productionTemplateHtmlCollection.push(productionTemplateHtml
      .replace(/:title:/g, production.title)
      .replace(/:type:/g, production.type)
      .replace(/:sites:/, Renderers[Templates.productionSite](production.sites).join('')));
  });

  container.innerHTML = productionTemplateHtmlCollection.join('');
}


class TemplateRenderer {

  static render(template, collection, container) {
    Renderers[template](collection, container);
  }
}

module.exports = { TemplateRenderer, Templates };