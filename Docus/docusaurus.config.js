// @ts-check
import {themes as prismThemes} from 'prism-react-renderer';

/** @type {import('@docusaurus/types').Config} */
const config = {
  title: 'SpendSmart',
  tagline: 'Controla tus gastos de forma fácil y eficaz',
  favicon: 'img/favicon.ico',

  // URL y baseUrl (ajusta según tu despliegue)
  url: 'https://github.com', // Cambia esto por tu URL
  baseUrl: '/GestorDeGastos/',

  // Configuración para GitHub Pages (opcional)
  organizationName: 'xsha256', // Cambia esto
  projectName: '/GestorDeGastos/', // Cambia esto
  deploymentBranch: "gh-pages",

  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'warn',

  // Internacionalización (puedes dejarlo en 'en' o cambiarlo)
  i18n: {
    defaultLocale: 'es',
    locales: ['es'],
  },

  presets: [
    [
      'classic',
      /** @type {import('@docusaurus/preset-classic').Options} */
      ({
        docs: {
          routeBasePath: '/', // Hace que la documentación sea la página principal
          sidebarPath: './sidebars.js', // Ruta a la configuración del sidebar
          editUrl: 'https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/', // Cambia esto
        },
        blog: {
          showReadingTime: true,
          feedOptions: {
            type: ['rss', 'atom'],
            xslt: true,
          },
          // Please change this to your repo.
          // Remove this to remove the "edit this page" links.
          editUrl:
            'https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/',
          // Useful options to enforce blogging best practices
          onInlineTags: 'warn',
          onInlineAuthors: 'warn',
          onUntruncatedBlogPosts: 'warn',
        },
        theme: {
          customCss: './src/css/custom.css',
        },
      }),
    ],
  ],

  themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
    ({
      // Imagen para redes sociales (opcional)
      image: 'img/portada.png', // Cambia esto si tienes una imagen

      // Barra de navegación
      navbar: {
        title: 'SpendSmart',
        logo: {
          alt: 'Logo de SpendSmart',
          src: 'img/favicon.ico', // Cambia esto si tienes un logo
        },
        items: [
          {
            to: 'Docus\docs\intro.md', // Ruta a la documentación principal
            label: 'Documentación',
            position: 'left',
          },
          {
            href: 'https://github.com/Yordaw/GestorDeGastos', // Cambia esto
            label: 'GitHub',
            position: 'right',
          },
        ],
      },

      // Pie de página
      footer: {
        style: 'dark',
        links: [
          {
            title: 'Documentación',
            items: [
              {
                label: 'Ir a Documentación',
                to: '/docs/intro',
              },
            ],
          },
          {
            title: 'Comunidad',
            items: [
              {
                label: 'GitHub',
                href: 'https://github.com/Yordaw/GestorDeGastos', // Cambia esto
              },
              {
                label: 'Twitter',
                href: 'https://x.com/docusaurus', // Cambia esto
              },
            ],
          },
        ],
        copyright: `Copyright © ${new Date().getFullYear()} SpendSmart. Built with Docusaurus.`,
      },

      // Configuración de Prism (sintaxis de código)
      prism: {
        theme: prismThemes.github,
        darkTheme: prismThemes.dracula,
      },
    }),
};

export default config;