import { ICalendarOptions } from "../interfaces/calendar.interface";
import { calendar } from "./calendar";
declare class DateDreamerCalendarToggle extends HTMLElement {
    element: Element | string;
    inputElement: Element | undefined;
    calendarElement: calendar | undefined;
    calendarWrapElement: Element | undefined;
    options: ICalendarOptions;
    inputPlaceholder: string;
    constructor(options: ICalendarOptions);
    init(): void;
    generateTemplate(): void;
    generateCalendar(): void;
    dateChangedHandler(e: CustomEvent<any>): void;
}
export { DateDreamerCalendarToggle as calendarToggle };
