import { ICalendarOptions } from "../interfaces/calendar.interface";
import CalendarConnector from "./connector";
declare class DateDreamerCalendar extends HTMLElement implements ICalendarOptions {
    element: Element | string;
    calendarElement: HTMLElement | null | undefined;
    headerElement: HTMLElement | null | undefined;
    inputsElement: HTMLElement | null | undefined;
    errorsElement: HTMLElement | null | undefined;
    format: string | undefined;
    iconNext: string | undefined;
    iconPrev: string | undefined;
    hidePrevNav?: boolean | undefined;
    hideNextNav?: boolean | undefined;
    inputLabel: string;
    inputPlaceholder: string;
    hideInputs: boolean;
    darkMode: boolean | undefined;
    hideOtherMonthDays: boolean | undefined;
    rangeMode: boolean | undefined;
    connector: CalendarConnector | undefined;
    onChange: ((event: CustomEvent) => void) | undefined;
    onRender: ((event: CustomEvent) => void) | undefined;
    onNextNav: ((event: CustomEvent) => void) | undefined;
    onPrevNav: ((event: CustomEvent) => void) | undefined;
    errors: Array<any>;
    daysElement: HTMLElement | null | undefined;
    selectedDate: Date;
    displayedMonthDate: Date;
    theme: "unstyled" | "lite-purple";
    styles: string;
    constructor(options: ICalendarOptions);
    private init;
    /**
     * Inserts calendar HTML into the element via query selector.
     * @param calendar Calendar HTML
     */
    private insertCalendarIntoSelector;
    /**
     * Generates the Previous, Title, and Next header elements.
     */
    private generateHeader;
    /**
     * Generates the date field and today button
     */
    private generateInputs;
    /**
     *  Generates errors pushed to the errors array.
     */
    private generateErrors;
    /**
     * Generates the day buttons
     */
    private generateDays;
    handleDayKeyDown: (e: KeyboardEvent) => void;
    /**
     * Go to previous month
     * @param e Event
     * @param focusLastDay Sets active focus on last day of previous month
     */
    goToPrevMonth: (e: Event, focusLastDay?: boolean) => void;
    /**
     * Go to next month
     * @param e Event
     * @param focusFirstDay Sets active focus on first day of next month
     */
    goToNextMonth: (e: Event, focusFirstDay?: boolean) => void;
    /**
     *
     * @param rebuildInput Rebuilds the input elements
     * @param focusFirstorLastDay Focuses the first or last day when the calendar is rebuilt.
     */
    rebuildCalendar(rebuildInput?: boolean, focusFirstorLastDay?: false | "first" | "last"): void;
    /**
     * Sets the selected day of the viewable month.
     * @param day The day of the month in number format.
     */
    private setSelectedDay;
    /**
     * Sets the given date as selected in the calendar.
     * @param date The new date to select in the calendar.
     */
    setDate(date: string | Date): void;
    /**
     * Sets the selected and viewable month to today.
     */
    setDateToToday(): void;
    /**
     * Handles the KeyUp event in the date textbox.
     * @param e KeyUp event
     */
    dateInputChanged(e: Event): void;
    /**
     * Triggers the onChange callback that was passed into the calendar options.
     * @param date The new date that has been selected in the calendar.
     */
    private dateChangedCallback;
    /**
     * Triggers the onRender callback that was passed into the calendar options.
     */
    private onRenderCallback;
    setDisplayedMonthDate(date: Date): void;
}
export { DateDreamerCalendar as calendar };
