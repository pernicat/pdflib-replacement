<?php
use Drola\PDF;

/**
 * Create PDF file
 * 
 * @param mixed  &$pdf     Reference to the new PDF resource
 * @param string $filename Filename
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_open_file(&$pdf, string $filename)
{
    $pdf = PDF::open_file($filename);
    return $pdf !== false ? true : false;
}

/**
 * Fill the author document info field
 * 
 * @param PDF    $pdf    PDF resource
 * @param string $author Author
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_set_info_author(PDF $pdf, string $author)
{
    return $pdf->set_info_author($author);
}

/**
 * Fill the creator document info field
 * 
 * @param PDF    $pdf     PDF resource
 * @param string $creator Creator
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_set_info_creator(PDF $pdf, string $creator)
{
    return $pdf->set_info_creator($creator);
}


/**
 * Fill the subject document info field
 * 
 * @param PDF    $pdf     PDF resource
 * @param string $subject Subject
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_set_info_subject(PDF $pdf, string $subject)
{
    return $pdf->set_info_subject($subject);
}

/**
 * Fill the keywords document info field
 * 
 * @param PDF    $pdf      PDF resource
 * @param string $keywords Keywords
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_set_info_keywords(PDF $pdf, string $keywords)
{
    return $pdf->set_info_keywords($keywords);
}

/**
 * Set font
 * 
 * @param PDF    $pdf      PDF resource
 * @param string $font     Font
 * @param int    $size     Font size
 * @param string $encoding Encoding
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_set_font(PDF $pdf, string $font, int $size, string $encoding)
{
    return $pdf->set_font($font, $size, $encoding);
}

/**
 * Output text at given position
 * Prints text in the current font.
 * 
 * @param PDF    $pdf  PDF resource
 * @param string $text Text
 * @param float  $x    X
 * @param float  $y    Y
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_show_xy(PDF $pdf, string $text, float $x, float $y)
{
    return $pdf->show_xy($text, $x, $y);
}

/**
 * Set fill color to gray
 * Sets the current fill color to a gray value between 0 and 1 inclusive.
 * 
 * @param PDF   $pdf  PDF resource
 * @param float $gray Grayness between 0 and 1
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_setgray_fill(PDF $pdf, float $gray)
{
    return $pdf->setgray_fill($gray);
}

/**
 * Return width of text
 * Returns the width of text in an arbitrary font.
 *  
 * @param PDF    $pdf  PDF resource
 * @param string $text Text
 *
 * @return float Width of text
 */
function PDF_stringwidth(PDF $pdf, string $text)
{
    return $pdf->stringwidth($text);
}

/**
 * Draw rectangle
 * Draws a rectangle.
 * 
 * @param PDF   $pdf    PDF resource
 * @param float $x      X
 * @param float $y      Y
 * @param float $width  Width
 * @param float $height Height
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_rect(PDF $pdf, float $x, float $y, float $width, float $height)
{
    return $pdf->rect($x, $y, $width, $height);
}

/**
 * Fill current path
 * Fills the interior of the current path with the current fill color.
 * 
 * @param PDF $pdf PDF resource
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_fill(PDF $pdf)
{
    return $pdf->fill();
}

/**
 * Set current point
 * Sets the current point for graphics output.
 * 
 * @param PDF   $pdf PDF resource
 * @param float $x   X
 * @param float $y   Y
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_moveto(PDF $pdf, float $x, float $y)
{
    return $pdf->moveto($x, $y);
}

/**
 * Draw a line
 * Draws a line from the current point to another point.
 * 
 * @param PDF   $pdf PDF resource
 * @param float $x   X
 * @param float $y   Y
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_lineto(PDF $pdf, float $x, float $y)
{
    return $pdf->lineto($x, $y);
}

/**
 * Stroke path
 * Strokes the path with the current color and line width, and clear it.
 *  
 * @param PDF $pdf PDF resource
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_stroke(PDF $pdf)
{
    return $pdf->stroke();
}

/**
 * Saves the current graphics state
 * 
 * @param PDF $pdf PDF resource
 * 
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_save(PDF $pdf)
{
    return $pdf->save();
}

/**
 * Clip to current path
 * Uses the current path as clipping path, and terminate the path.
 * 
 * @param PDF $pdf PDF resource
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_clip(PDF $pdf)
{
    return $pdf->clip();
}

/**
 * Restore graphics state
 * Restores the most recently saved graphics state.
 * 
 * @param PDF $pdf PDF resource
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_restore(PDF $pdf)
{
    return $pdf->restore();
}

/**
 * Start new page
 *
 * Adds a new page to the document.
 * 
 * @param PDF   $pdf    PDF resource
 * @param float $width  Width
 * @param float $height Height
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_begin_page(PDF $pdf, float $width, float $height)
{
    return $pdf->begin_page();
}

/**
 * Finish page
 * Finishes the page.
 * 
 * @param PDF $pdf PDF resource
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_end_page(PDF $pdf)
{
    return $pdf->end_page();
}

/**
 * Set origin of coordinate system
 * Translates the origin of the coordinate system. 
 *  
 * @param PDF   $pdf PDF resource
 * @param float $tx  X
 * @param float $ty  Y
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_translate(PDF $pdf, float $tx, float $ty)
{
    return $pdf->translate();
}

/**
 * Close pdf resource
 * Closes the generated PDF file, and frees all document-related resources.
 * 
 * @param PDF $pdf PDF resource
 *
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_close(PDF $pdf)
{
    return $pdf->close();
}

/**
 * Add bookmark for current page
 * 
 * @param PDF    $pdf  PDF resource
 * @param string $text Bookmark title
 * 
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function PDF_add_outline(PDF $pdf, string $text)
{
    return $pdf->add_outline($text);
}
