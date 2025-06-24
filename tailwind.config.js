/** @type {import('tailwindcss').Config} */

const defaultColors = require('tailwindcss/colors')

// Pas de kleuren hieronder aan naar de gewenste kleuren. Dit mag HEX, RGB, HSL of TailwindCSS kleuren zijn.
// Enkel de kleuren die in de templates worden gebruikt, worden naar de CSS weggeschreven.

// Primaire kleur (tinten)
const primaryColors = {
    DEFAULT: defaultColors.blue[500],
    50: defaultColors.blue[50],
    100: defaultColors.blue[100],
    200: defaultColors.blue[200],
    300: defaultColors.blue[300],
    400: defaultColors.blue[400],
    500: defaultColors.blue[500],
    600: defaultColors.blue[600],
    700: defaultColors.blue[700],
    800: defaultColors.blue[800],
    900: defaultColors.blue[900],
    950: defaultColors.blue[950],
}

// Eventuele secondaire kleur (tinten)
const secondaryColors = {
    DEFAULT: defaultColors.sky[500],
    50: defaultColors.sky[50],
    100: defaultColors.sky[100],
    200: defaultColors.sky[200],
    300: defaultColors.sky[300],
    400: defaultColors.sky[400],
    500: defaultColors.sky[500],
    600: defaultColors.sky[600],
    700: defaultColors.sky[700],
    800: defaultColors.sky[800],
    900: defaultColors.sky[900],
    950: defaultColors.sky[950],
}

// Voor accenten
const accentColors = {
    DEFAULT: defaultColors.violet[500],
    50: defaultColors.violet[50],
    100: defaultColors.violet[100],
    200: defaultColors.violet[200],
    300: defaultColors.violet[300],
    400: defaultColors.violet[400],
    500: defaultColors.violet[500],
    600: defaultColors.violet[600],
    700: defaultColors.violet[700],
    800: defaultColors.violet[800],
    900: defaultColors.violet[900],
    950: defaultColors.violet[950],
}

// Voor teksten en koppen
const contentColors = {
    DEFAULT: defaultColors.gray[800], // global body color
    50: defaultColors.gray[50],
    100: defaultColors.gray[100],
    200: defaultColors.gray[200],
    300: defaultColors.gray[300],
    400: defaultColors.gray[400],
    500: defaultColors.gray[500],
    600: defaultColors.gray[600],
    700: defaultColors.gray[700],
    800: defaultColors.gray[800],
    900: defaultColors.gray[900],
    950: defaultColors.gray[950],
}

// State kleuren
const infoColors = {
    DEFAULT: defaultColors.blue[500],
    50: defaultColors.blue[50],
    100: defaultColors.blue[100],
    200: defaultColors.blue[200],
    300: defaultColors.blue[300],
    400: defaultColors.blue[400],
    500: defaultColors.blue[500],
    600: defaultColors.blue[600],
    700: defaultColors.blue[700],
    800: defaultColors.blue[800],
    900: defaultColors.blue[900],
    950: defaultColors.blue[950],
}

const succesColors = {
    DEFAULT: defaultColors.green[500],
    50: defaultColors.green[50],
    100: defaultColors.green[100],
    200: defaultColors.green[200],
    300: defaultColors.green[300],
    400: defaultColors.green[400],
    500: defaultColors.green[500],
    600: defaultColors.green[600],
    700: defaultColors.green[700],
    800: defaultColors.green[800],
    900: defaultColors.green[900],
    950: defaultColors.green[950],
}

const warningColors = {
    DEFAULT: defaultColors.orange[500],
    50: defaultColors.orange[50],
    100: defaultColors.orange[100],
    200: defaultColors.orange[200],
    300: defaultColors.orange[300],
    400: defaultColors.orange[400],
    500: defaultColors.orange[500],
    600: defaultColors.orange[600],
    700: defaultColors.orange[700],
    800: defaultColors.orange[800],
    900: defaultColors.orange[900],
    950: defaultColors.orange[950],
}

const errorColors = {
    DEFAULT: defaultColors.red[500],
    50: defaultColors.red[50],
    100: defaultColors.red[100],
    200: defaultColors.red[200],
    300: defaultColors.red[300],
    400: defaultColors.red[400],
    500: defaultColors.red[500],
    600: defaultColors.red[600],
    700: defaultColors.red[700],
    800: defaultColors.red[800],
    900: defaultColors.red[900],
    950: defaultColors.red[950],
}

module.exports = {
    theme: {
        extend: {
            screens: {
                sm: { max: '640px' },
                md: { max: '768px' },
                lg: { max: '991px' },
                xl: { max: '1280px' },
                '2xl': { max: '1536px' },
            },
        },
    },
    content: [
        // './webroot/wp-content/plugins/raadhuis-*/**/*.{php,twig,.html,vue,blade.php,js}',
        './webroot/wp-content/themes/raadhuis/**/*.{php,twig,json,.html,vue,blade.php,js}',
        './webroot/wp-content/themes/raadhuis-*/**/*.{php,twig,json,.html,vue,blade.php,js}',
        './src/assets/**/*.{html,css,js}',
        './src/**/*.{njk,js,html,md,yml,yaml}',
    ],
    // safelist: ["bg-primary-700", "bg-secondary-700", "bg-accent-700"],
    darkMode: 'media', // or 'media' or 'class'
    important: false,
    theme: {
        extend: {
            fontFamily: {
                heading: ['Inter', 'sans-serif'],
                body: ['Inter', 'sans-serif'],
                code: ['Open Sans', 'proxima_nova', 'sans-serif'],
                handwriting: ['Open Sans', 'proxima_nova', 'sans-serif'],
            },
            colors: {
                 "schildklier-purple": "#694F9C",
             "schildklier-light": "#FAF5F5",
             "schildklier-yellow": "#FCC73D",
             "schildklier-text": "#303030",
                'green': "#3AAA35",
                'brand-yellow': '#FCC73D',
                'brand-purple': '#694F9C',
                'brand-purple-dark': '#584283', // Iets donkerder voor hover/actief
                'brand-purple-light': '#8A72B8', // Iets lichter voor focus/subtiele hover
                'brand-gray': '#FAF5F5', // Lichte achtergrondgrijs
                'brand-text': '#374151', // Standaard donkergrijze tekst (Tailwind's gray-700)
                'brand-text-on-purple': '#FFFFFF', // Witte tekst voor op paarse achtergronden
                // Primaire kleur (tinten)
                primary: primaryColors,

                // Eventuele secondaire kleur (tinten)
                secondary: secondaryColors,

                // Voor accenten
                accent: accentColors,

                // Voor teksten en koppen
                content: contentColors,

                // State kleuren
                info: infoColors,
                success: succesColors,
                warning: warningColors,
                error: errorColors,

                // Handig om te kunnen gebruiken
                transparent: 'transparent',
                current: 'currentColor',
                inherit: 'inherit',
            },
            screens: {
                '2xl': '1366px',
                '3xl': '1440px',
                '4xl': '1600px',
                // '5xl': '1920px',
                // '6xl': '2560px',
            },
            lineHeight: {
                xtight: '1.15',
            },
            fontSize: {
                11: '0.6875rem',
                12: '0.75rem', // xs
                14: '0.875rem', // sm
                15: '0.9375rem',
                16: '1rem', // base
                18: '1.125rem', // lg
                20: '1.25rem', // xl
                22: '1.375rem',
                24: '1.5rem',
                28: '1.75rem',
                32: '2rem',
                36: '2.25rem',
                40: '2.5rem',
                44: '2.75rem',
                48: '3rem',
                52: '3.25rem',
                58: '3.5rem',
                64: '4rem',
                68: '4.25rem',
                72: '4.5rem',
                76: '4.75rem',
                80: '5rem',
                83: '5.25rem',
                88: '5.5rem',
                92: '5.25rem',
                96: '6rem',
                100: '6.25rem',
            },
            borderRadius: {
                none: '0',
                sm: '0.125rem',
                DEFAULT: '0.3125rem',
                md: '0.5rem',
                lg: '0.75rem',
                full: '9999px',
            },
            maxWidth: {
                xxs: '15rem',
            },
            boxShadow: {
                xs: '0 0 0 1px rgba(0, 0, 0, 0.05)',
                sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                DEFAULT: '0 4px 24px 0 rgba(48, 81, 93, 0.08)',
                md: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                xl: '0 8px 48px 0 rgba(48, 81, 93, 0.12)',
                '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
                inner: 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
                outline: '0 0 0 3px rgba(66, 153, 225, 0.5)',
                none: 'none',
            },
            transitionProperty: {
                visibility:
                    'visibility, opacity, transform, top, left, bottom, right',
            },
            transitionDuration: {
                400: '400ms',
                2000: '2000ms',
            },
            animation: {
                preloader: 'spin .75s linear infinite',
            },
            zIndex: {
                auto: 'auto',
                '-1': '-1',
                0: '0',
                1: '1',
                2: '2',
                3: '3',
                4: '4',
                5: '5',
                10: '10',
                20: '20',
                30: '30',
                40: '40',
                50: '50',
                60: '60',
                70: '70',
                80: '80',
                90: '90',
                99: '99',
            },

            // TailwindCSS Typography (prose) kleuren
            typography: {
                DEFAULT: {
                    css: {
                        color: defaultColors.content,
                        a: null,
                    },
                },
            },
        },
    },

    // Laat DasiyUI de kleuren van TailwindCSS gebruiken, welke we hierboven hebben ingesteld.
    daisyui: {
        styled: true,
        themes: [
            {
                raadhuis: {
                    primary: primaryColors.DEFAULT,
                    'primary-focus': primaryColors[600],
                    'primary-content': defaultColors.white,

                    secondary: secondaryColors.DEFAULT,
                    'secondary-focus': secondaryColors[600],
                    'secondary-content': defaultColors.white,

                    accent: accentColors.DEFAULT,
                    'accent-focus': accentColors[600],
                    'accent-content': defaultColors.white,

                    // Used in some components:
                    'base-content': contentColors.DEFAULT,
                    'base-100': contentColors[100],
                    'base-200': contentColors[200],
                    'base-300': contentColors[300],

                    // DaisyUI specific state colors, use same as TailwindCSS:
                    info: infoColors[500],
                    'info-content': defaultColors.white,
                    success: succesColors[500],
                    'success-content': defaultColors.white,
                    warning: warningColors[500],
                    'warning-content': defaultColors.white,
                    error: errorColors[500],
                    'error-content': defaultColors.white,
                },
            },
        ],
    },

    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        // require('daisyui'),
    ],
}
