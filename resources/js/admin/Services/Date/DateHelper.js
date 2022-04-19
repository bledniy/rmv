import parseISO from 'date-fns/parseISO';
import formatDistanceToNowStrict from 'date-fns/formatDistanceToNowStrict';
import ru from 'date-fns/locale/ru';

export default class DateHelper {
    /**
     * @param date {Date}
     * @returns {string | *}
     */
    static formatDistanceToNowStrict(date) {
        return formatDistanceToNowStrict(parseISO(date), {locale: ru, addSuffix: true});
    }

    /**
     * @param date {Date}
     * @returns {string | *}
     */
    static toNormalDateFormat(date) {
        return parseISO(date).toLocaleString().replace(',', '').replaceAll('.', '-')
    }
    static now(){
        return this.toNormalDateFormat(new Date());
    }
}