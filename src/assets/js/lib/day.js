// DayJS
import dayjs from 'dayjs';

// DayJS NL locale
import 'dayjs/locale/nl'

// DayJS plugins
import duration from 'dayjs/plugin/duration';
import utc from 'dayjs/plugin/utc';
import timezone from 'dayjs/plugin/timezone';
import isoWeek from 'dayjs/plugin/isoWeek';
import isBetween from 'dayjs/plugin/isBetween';
import customParseFormat from 'dayjs/plugin/customParseFormat';
import localizedFormat from 'dayjs/plugin/localizedFormat';

// Extend DayJS with plugins
dayjs.extend(utc)
dayjs.extend(timezone)
dayjs.extend(duration)
dayjs.extend(isoWeek)
dayjs.extend(isBetween)
dayjs.extend(customParseFormat)
dayjs.extend(localizedFormat)

dayjs.tz.setDefault("Europe/Amsterdam");

window.dayjs = dayjs;