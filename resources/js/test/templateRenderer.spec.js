import { TemplateRenderer, Templates } from '../templateRenderer.js';

const production = {
  title: 'Preacher',
  type: 'TV Series',
  sites: [
    {
        name: 'Gertrude Zachary',
        shoot_date: 'May 13, 2015'
    },
    {
        name: 'Bea\'s Mexican Restaurant 2',
        shoot_date: 'May 25, 2015'
    }
  ]
};

const container = document.createElement('div');

test('it can render a production', () => {

  TemplateRenderer.render(Templates.production, [production], container);

  expect(container.querySelectorAll('.productionCard').length).toBe(1);
  expect(container.querySelectorAll('.productionCard .title')[0].innerHTML).toBe(production.title);
  expect(container.querySelectorAll('.productionCard .type')[0].innerHTML).toBe(production.type);
});

test('it can render a production site', () => {

  TemplateRenderer.render(Templates.productionSite, [production], container);

  const siteBlocks = container.querySelectorAll('.sites .site');

  expect(container.querySelectorAll('.sites').length).toBe(1);
  expect(siteBlocks.length).toBe(production.sites.length);
  expect(container.querySelectorAll('.sites .site .name')[0].innerHTML).toBe(production.sites[0].name)
  expect(container.querySelectorAll('.sites .site .shoot-date')[0].innerHTML).toBe(production.sites[0].shoot_date)
});

