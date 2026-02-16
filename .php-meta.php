<?php

/**
 * This file is purely for PHP namespace resolution suppression
 * It allows IDE to understand common JavaScript APIs that appear in PHP view files
 * 
 * @noinspection PhpUndefinedClassInspection
 * @noinspection PhpUndefinedFunctionInspection
 * @noinspection PhpUnused
 */

// JavaScript built-in objects used in view templates
class FormData { }
class FileReader { }
class File { }
class Blob { }
class URLSearchParams { }
class RequestInit { }
class Response { }
class Request { }
class Headers { }
class Event { }
class EventTarget { }
class AbortController { }
class AbortSignal { }
class ReadableStream { }
class WritableStream { }
class Date { }
class Document { }
class Window { }
class HTMLElement { }
class Element { }
class HTMLFormElement { }
class HTMLInputElement { }
class HTMLTextAreaElement { }
class HTMLSelectElement { }
class HTMLImageElement { }
class HTMLButtonElement { }
class HTMLDivElement { }
class HTMLSpanElement { }
class HTMLTableElement { }
class HTMLTableRowElement { }
class HTMLTableCellElement { }
class DragEvent { }
class ProgressEvent { }
class NodeList { }
class HTMLCollection { }
class NamedNodeMap { }
class Attr { }
class CSSStyleDeclaration { }
class DOMRect { }
class DOMTokenList { }
class Storage { }
class RegExp { }
class Array { }
class Set { }
class Map { }
class WeakMap { }
class WeakSet { }
class Promise { }
class PromiseRejectionEvent { }
class Console { }
class Math { }
class JSON { }
class XMLHttpRequest { }
class FormDataEntryValue { }

// Third-party library classes
class Swiper { }
class AOS { }
class Toastr { }
class Alert { }
class Chart { }

// Global browser functions
function fetch() { }
function setTimeout() { }
function setInterval() { }
function clearTimeout() { }
function clearInterval() { }
function setImmediate() { }
function clearImmediate() { }
function requestAnimationFrame() { }
function cancelAnimationFrame() { }
function eval() { }
function alert() { }
function confirm() { }
function console() { }
function JSON() { }
function Math() { }
function parseFloat() { }
function parseInt() { }
function isNaN() { }
function isFinite() { }
function decodeURI() { }
function decodeURIComponent() { }
function encodeURI() { }
function encodeURIComponent() { }

// Browser global objects
class Navigator { }
class Window { }
class Document { }
class HTMLElement { }
class Element { }
class Node { }
class CSSStyleDeclaration { }
class DOMTokenList { }
class HTMLCollection { }
class NodeList { }
class DocumentFragment { }
class HTMLFormElement { }
class HTMLInputElement { }
class HTMLButtonElement { }
class HTMLSelectElement { }
class HTMLTextAreaElement { }
class HTMLImageElement { }
class Storage { }

// Suppress warnings for these as they're used in views
function console_log() { }
function console_error() { }
function document_getElementById() { }
function document_querySelector() { }
function document_querySelectorAll() { }
function window_location() { }

\
