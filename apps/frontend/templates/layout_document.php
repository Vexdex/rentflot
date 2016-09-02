<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <style type="text/css">
      html, body, div, span, applet, object, iframe,
      h1, h2, h3, h4, h5, h6, p, blockquote, pre,
      a, abbr, acronym, address, big, cite, code,
      del, dfn, em, font, img, ins, kbd, q, s, samp,
      small, strike, strong, sub, sup, tt, var,
      b, u, i, center,
      dl, dt, dd, ol, ul, li,
      fieldset, form, label, legend,
      table, caption, tbody, tfoot, thead, tr, th, td {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        font-size: 100%;
        vertical-align: baseline;
        background: transparent;
      }

      ol, ul {
        list-style: none;
      }
      blockquote, q {
        quotes: none;
      }
      blockquote:before, blockquote:after,
      q:before, q:after {
        content: '';
        content: none;
      }

      /* remember to define focus styles! */
      :focus, :active, :hover {
        outline: 0;
      }

      /* remember to highlight inserts somehow! */
      ins {
        text-decoration: none;
      }
      del {
        text-decoration: line-through;
      }

      /* tables still need 'cellspacing="0"' in the markup */
      table {
        border-collapse: collapse;
        border-spacing: 0;
        empty-cells: show;
        width: 100%;
      }
      body { background-color: #ffffff;  }
      html, body, table td, table th, li, input, select, option, textarea, p, label {font-family: Tahoma; font-size: 9pt; color: #222222; line-height: 11pt;}
      
      p {margin: 10px 0; }
      
      h1 { font-size: 14pt; margin: 15px 0 20px 0}
      table.Bordered td, table.Bordered th { border: 1px solid #333; text-align: center }

      /* Работает только inline css */
      <?php echo file_get_contents(sfConfig::get('sf_web_dir').'/css/backend/reports.css') ?>

  </style>
  <?php //<link rel="stylesheet" type="text/css" href="/css/backend/reports.css" /> ?>
  </head>

  <body>
    <table cellspacing="0" style="height: 100%; width:100%" align="center">
      <tr>
        <td>
          <?php echo $sf_content ?>
        </td>
      </tr>
    </table>
  </body>
</html>
