const colors = require('tailwindcss/colors')

module.exports = {
    prefix: 'rt-',
    content: [
        './admin/**/*.{php,twig,json,html,css,js}',
        './public/**/*.{php,twig,json,html,css,js}',
    ],
    darkMode: 'media', // or 'media' or 'class'
    important: false,
    theme: {
        extend: {
            fontFamily: {
                heading: ['Open Sans', 'sans-serif'],
                sans: ['Open Sans', 'sans-serif'],
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                inherit: 'inherit',

                info: {
                    DEFAULT: '#00c8d9',
                },

                success: {
                    DEFAULT: '#00c375',
                },

                warning: {
                    DEFAULT: '#f7c142',
                },

                alert: {
                    DEFAULT: '#e24037',
                },

                primary: {
                    DEFAULT: '#3958E9',
                    50: '#F3F5FE',
                    100: '#DEE3FB',
                    200: '#B5C1F7',
                    300: '#8C9EF2',
                    400: '#627BEE',
                    500: '#3958E9',
                    600: '#1738D3',
                    700: '#122BA0',
                    800: '#0C1D6E',
                    900: '#07103B',
                    950: '#040922'
                },

                content: {
                    DEFAULT: '#000000',
                    // 50: '',
                    // 100: '',
                    // 200: '',
                    // 300: '',
                    // 400: '#000000',
                    // 500: '',
                    // 600: '',
                    // 700: '',
                    // 800: '',
                    // 900: '',
                    // 950: '',
                },
            },
            screens: {
                '2xl': '1366px',
                '3xl': '1440px',
                '4xl': '1600px',
                '5xl': '1920px',
                '6xl': '2560px',
            },
            fontSize: {
                xxs: '0.6875rem',
                xs: '0.75rem',
                sm: '0.875rem',
                md: '0.9375rem',
                base: '1rem',
                lg: '1.125rem',
                xl: '1.25rem',
                '2xl': '1.5rem',
                '3xl': '2rem',
                '4xl': '2.5rem',
                '5xl': '3rem',
                '6xl': '4rem',
                '7xl': '4.5rem',
                '8xl': '5rem',
                '9xl': '6rem',
                '10xl': '7rem',
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
                9999: '9999',
            },
        },
    },
    plugins: [
        // require('@tailwindcss/typography'),
        // require('@tailwindcss/forms'),
    ],
}
