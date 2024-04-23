import { IRangeOptions } from "../interfaces/range.interface";
import { calendar } from "./calendar";
import CalendarConnector from "./connector";
declare class DateDreamerRange extends HTMLElement implements IRangeOptions {
    calendar1: calendar | undefined;
    calendar2: calendar | undefined;
    calendar1DisplayedDate: Date;
    calendar2DisplayedDate: Date;
    element: string | Element;
    theme?: "lite-purple" | "unstyled" | undefined;
    styles?: string | undefined;
    format?: string | undefined;
    iconPrev?: string | undefined;
    iconNext?: string | undefined;
    darkMode?: boolean | undefined;
    onChange?: ((event: CustomEvent<any>) => void) | undefined;
    onRender?: ((event: CustomEvent<any>) => void) | undefined;
    selectedStartDate: Date | undefined;
    selectedEndDate: Date | undefined;
    connector: CalendarConnector | undefined;
    constructor(options: IRangeOptions);
    /**
     * Initialize parent div element and inject both calendars.
     */
    init(): void;
    addStyles(): void;
    prevHandler(e: CustomEvent): void;
    nextHandler(e: CustomEvent): void;
    resetViewedDated(): void;
    handleDateChange: (e: CustomEvent) => void;
}
export { DateDreamerRange as range };
