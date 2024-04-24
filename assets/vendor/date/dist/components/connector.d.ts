import { ICalendarConnector } from "../interfaces/connector.interface";
import { calendar } from "./calendar";
export default class CalendarConnector implements ICalendarConnector {
    startDate: Date | null;
    endDate: Date | null;
    pickingEndDate: Date | null;
    calendars: Array<calendar>;
    dateChangedCallback?: ((event: CustomEvent) => void) | undefined;
    constructor();
    rebuildAllCalendars(): void;
}
