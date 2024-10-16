
@extends('layouts/contentLayoutMaster')

@section('title', 'Typography')

@section('content')
<!-- Headings -->
<section id="html-headings-default" class="row match-height">
  <div class="col-sm-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">HTML headings <small class="text-muted">Default</small></h4>
      </div>
      <div class="card-body pb-1">
        <p class="card-text">
          All HTML headings, <code>&lt;h1&gt;</code> through <code>&lt;h6&gt;</code>, are available.
          <code>.h1</code> through <code>.h6</code> classes are also available, for when you want to match the font
          styling of a heading.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <thead>
            <tr>
              <th>Preview</th>
              <th class="text-end">Font Size</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <h1>H1 Heading</h1>
              </td>
              <td class="type-info text-end">2rem</td>
            </tr>
            <tr>
              <td>
                <h2>H2 Heading</h2>
              </td>
              <td class="type-info text-end">1.714rem</td>
            </tr>
            <tr>
              <td>
                <h3>H3 Heading</h3>
              </td>
              <td class="type-info text-end">1.5rem</td>
            </tr>
            <tr>
              <td>
                <h4>H4 Heading</h4>
              </td>
              <td class="type-info text-end">1.286rem</td>
            </tr>
            <tr>
              <td>
                <h5>H5 Heading</h5>
              </td>
              <td class="type-info text-end">1.07rem</td>
            </tr>
            <tr>
              <td>
                <h6>H6 Heading</h6>
              </td>
              <td class="type-info text-end">1rem</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Light / Bold Headings</h4>
      </div>
      <div class="card-body pb-1">
        <p class="card-text">
          All HTML headings are available with light and bold font-weight. Use <code>.fw-normal</code> for light heading
          and <code>.fw-bolder</code> for bold headings along with heading tags or classes.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <thead>
            <tr>
              <th>Light headings</th>
              <th class="text-end">Bold headings</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <h1 class="fw-normal">Heading 1</h1>
              </td>
              <td class="text-end">
                <h1 class="fw-bolder">Heading 1</h1>
              </td>
            </tr>
            <tr>
              <td>
                <h2 class="fw-normal">Heading 2</h2>
              </td>
              <td class="text-end">
                <h2 class="fw-bolder">Heading 2</h2>
              </td>
            </tr>
            <tr>
              <td>
                <h3 class="fw-normal">Heading 3</h3>
              </td>
              <td class="text-end">
                <h3 class="fw-bolder">Heading 3</h3>
              </td>
            </tr>
            <tr>
              <td>
                <h4 class="fw-normal">Heading 4</h4>
              </td>
              <td class="text-end">
                <h4 class="fw-bolder">Heading 4</h4>
              </td>
            </tr>
            <tr>
              <td>
                <h5 class="fw-normal">Heading 5</h5>
              </td>
              <td class="text-end">
                <h5 class="fw-bolder">Heading 5</h5>
              </td>
            </tr>
            <tr>
              <td>
                <h6 class="fw-normal">Heading 6</h6>
              </td>
              <td class="text-end">
                <h6 class="fw-bolder">Heading 6</h6>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<!--/ Headings -->

<!-- Customizing headings -->
<section id="customizing-headings-default" class="row match-height">
  <div class="col-sm-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Customizing headings <small class="text-muted">Default</small></h4>
      </div>
      <div class="card-body pb-1">
        <p class="card-text">Use the included utility classes to recreate the small secondary heading text.</p>
      </div>
      <div class="table-responsive">
        <table class="table table-mx-0 table-borderless mb-0">
          <tbody>
            <tr>
              <td>
                <h1>Heading <small class="text-muted">Secondary text</small></h1>
              </td>
            </tr>
            <tr>
              <td>
                <h2>Heading <small class="text-muted">Secondary text</small></h2>
              </td>
            </tr>
            <tr>
              <td>
                <h3>Heading <small class="text-muted">Secondary text</small></h3>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Heading <small class="text-muted">Secondary text</small></h4>
              </td>
            </tr>
            <tr>
              <td>
                <h5>Heading <small class="text-muted">Secondary text</small></h5>
              </td>
            </tr>
            <tr>
              <td>
                <h6>Heading <small class="text-muted">Secondary text</small></h6>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Heading colors</h4>
      </div>
      <div class="card-body pb-1">
        <p class="card-text">
          Heading elements are also changed with different color options. Use <code>.text-{colorName}</code> class with
          heading elements.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-mx-0 table-borderless mb-0">
          <tbody>
            <tr>
              <td>
                <h1 class="text-primary">Heading 1</h1>
              </td>
            </tr>
            <tr>
              <td>
                <h2 class="text-success">Heading 2</h2>
              </td>
            </tr>
            <tr>
              <td>
                <h3 class="text-danger">Heading 3</h3>
              </td>
            </tr>
            <tr>
              <td>
                <h4 class="text-warning">Heading 4</h4>
              </td>
            </tr>
            <tr>
              <td>
                <h5 class="text-info">Heading 5</h5>
              </td>
            </tr>
            <tr>
              <td>
                <h6>Heading 6</h6>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<!--/ Customizing headings -->

<!-- Display headings -->
<section id="display-headings" class="card">
  <div class="card-header">
    <h4 class="card-title">Display headings</h4>
  </div>
  <div class="card-body pb-1">
    <p class="card-text">
      Traditional heading elements are designed to work best in the meat of your page new-admin.content. When you need a heading
      to stand out, consider using a <strong>display heading</strong> — a larger, slightly more opinionated heading
      style.
    </p>
  </div>
  <div class="table-responsive">
    <table class="table table-mx-0 table-borderless mb-0">
      <tbody>
        <tr>
          <td>
            <h1 class="display-1">Display 1</h1>
          </td>
        </tr>
        <tr>
          <td>
            <h1 class="display-2">Display 2</h1>
          </td>
        </tr>
        <tr>
          <td>
            <h1 class="display-3">Display 3</h1>
          </td>
        </tr>
        <tr>
          <td>
            <h1 class="display-4">Display 4</h1>
          </td>
        </tr>
        <tr>
          <td>
            <h1 class="display-5">Display 5</h1>
          </td>
        </tr>
        <tr>
          <td>
            <h1 class="display-6">Display 6</h1>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>
<!--/ Display headings-->

<!-- Blockquotes -->
<section id="blockquotes" class="row">
  <div class="col-md-12 mt-1">
    <div class="group-area">
      <h4>Blockquotes</h4>
      <p>
        For quoting blocks of content from another source within your document. Wrap
        <code class="highlighter-rouge">&lt;blockquote class="blockquote"&gt;</code> around any
        <abbr title="HyperText Markup Language">HTML</abbr> as the quote.
      </p>
      <hr />
    </div>
  </div>
</section>

<!-- Blockquotes basic-->
<section id="blockquotes-default" class="row match-height">
  <div class="col-sm-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Blockquotes <small class="text-muted">Default</small></h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Left aligned basic blockquotes. Use text utilities classes like <code>.text-center / .text-end</code> as
          needed to change the alignment of your blockquote.
        </p>
        <blockquote class="blockquote">
          <p>Design is not just what it looks like and feels like. Design is how it works.</p>
        </blockquote>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Naming a source <small class="text-muted">Default</small></h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Add a <code class="highlighter-rouge">&lt;footer class="blockquote-footer"&gt;</code> for identifying the
          source. Wrap the name of the source work in <code class="highlighter-rouge">&lt;cite&gt;</code>.
        </p>
        <blockquote class="blockquote">
          <p>
            Being the richest man in the cemetery doesn't matter to me. Going to bed at night saying we've done
            something wonderful, that's what matters to me.
          </p>
          <footer class="blockquote-footer">
            Steve Jobs
            <cite title="Source Title">Entrepreneur</cite>
          </footer>
        </blockquote>
      </div>
    </div>
  </div>
</section>
<!--/ Blockquotes basic -->

<!-- Blockquotes styling -->
<section id="blockquotes-styling-default" class="row match-height">
  <div class="col-sm-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Blockquotes styling <small class="text-muted">Default</small></h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Add a <code class="highlighter-rouge">.border-{start/end}-{color} .border-{start/end}-3</code> helper classes,
          where color can be any color from Vuexy Admin color palette.
        </p>
        <blockquote class="blockquote ps-1 border-start-primary border-start-3">
          <p>
            Sometimes when you innovate, you make mistakes. It is best to admit them quickly, and get on with improving
            your other innovations.
          </p>
          <footer class="blockquote-footer">
            Steve Jobs
            <cite title="Source Title">Entrepreneur</cite>
          </footer>
        </blockquote>
        <blockquote class="blockquote pe-1 mt-2 text-end border-end-primary border-end-3">
          <p>
            Sometimes when you innovate, you make mistakes. It is best to admit them quickly, and get on with improving
            your other innovations.
          </p>
          <footer class="blockquote-footer">
            Steve Jobs
            <cite title="Source Title">Entrepreneur</cite>
          </footer>
        </blockquote>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Blockquotes with avatar <small class="text-muted">Default</small></h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Blockquotes with avatar. it use Media Object. You can customize image type, border alignment & style.
        </p>
        <blockquote class="blockquote ps-1 border-start-primary border-start-3">
          <div class="d-flex flex-row">
            <div class="me-1">
              <img
                src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                alt="Generic placeholder image"
                height="64"
                width="64"
              />
            </div>
            <div class="more-info">Sometimes life is going to hit you in the head with a brick. Don't lose faith.</div>
          </div>
          <footer class="blockquote-footer text-end">
            Steve Jobs
            <cite title="Source Title">Entrepreneur</cite>
          </footer>
        </blockquote>
        <p class="card-text mt-2">Blockquotes with avatar rounded image example</p>
        <blockquote class="blockquote mt-1">
          <div class="d-flex flex-row">
            <div class="me-1">
              <img
                class="rounded-circle"
                src="{{asset('images/portrait/small/avatar-s-3.jpg')}}"
                alt="Generic placeholder image"
                height="64"
                width="64"
              />
            </div>
            <div class="more-info">Sometimes life is going to hit you in the head with a brick. Don't lose faith.</div>
          </div>
          <footer class="blockquote-footer text-end">
            Steve Jobs
            <cite title="Source Title">Entrepreneur</cite>
          </footer>
        </blockquote>
      </div>
    </div>
  </div>
</section>
<!--/ Blockquotes styling -->

<!-- Lists -->
<section id="lists">
  <div class="row">
    <div class="col-md-12 mt-1">
      <div class="group-area">
        <h4>Lists</h4>
        <p>
          All lists - <code>&lt;ul&gt;</code>, <code>&lt;ol&gt;</code>, and <code>&lt;dl&gt;</code> - have their
          margin-top removed and a <code>margin-bottom: 1rem</code>. Nested lists have no <code>margin-bottom</code>.
        </p>
        <hr />
      </div>
    </div>
  </div>
  <div class="row match-height">
    <!-- Lists Unstyled -->
    <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Lists Unstyled</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Use class <code>.list-unstyled</code> for Lists Unstyled. It remove the default
            <code class="highlighter-rouge">list-style</code> and left margin on list items (immediate children only).
            <strong>This only applies to immediate children list items</strong>, meaning you will need to add the class
            for any nested lists as well.
          </p>
          <ul class="list-unstyled">
            <li>Lorem ipsum dolor sit amet</li>
            <li>Consectetur adipiscing elit</li>
            <li>Integer molestie lorem at massa</li>
            <li>Facilisis in pretium nisl aliquet</li>
            <li>
              Nulla volutpat aliquam velit
              <ul>
                <li>Phasellus iaculis neque</li>
                <li>Purus sodales ultricies</li>
                <li>Vestibulum laoreet porttitor sem</li>
                <li>Ac tristique libero volutpat at</li>
              </ul>
            </li>
            <li>Faucibus porta lacus fringilla vel</li>
            <li>Aenean sit amet erat nunc</li>
            <li>Eget porttitor lorem</li>
          </ul>
        </div>
      </div>
    </div>
    <!--/ Lists Unstyled -->
    <!-- Lists Unordered -->
    <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Lists Unordered <small class="text-muted">Default</small></h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            List of items in which the order does not explicitly matter. Use <code>.list-style-circle</code> or
            <code>.list-style-square</code> class in unordered list to add circle or square bullet points.
          </p>
          <ul>
            <li>Lorem ipsum dolor sit amet</li>
            <li>Consectetur adipiscing elit</li>
            <li>Integer molestie lorem at massa</li>
            <li>Facilisis in pretium nisl aliquet</li>
            <li>
              Nulla volutpat aliquam velit
              <ul>
                <li>Phasellus iaculis neque</li>
                <li>Purus sodales ultricies</li>
                <li>Vestibulum laoreet porttitor sem</li>
                <li>Ac tristique libero volutpat at</li>
              </ul>
            </li>
            <li>Faucibus porta lacus fringilla vel</li>
            <li>Aenean sit amet erat nunc</li>
            <li>Eget porttitor lorem</li>
          </ul>
        </div>
      </div>
    </div>
    <!--/ Lists Unordered -->
    <!-- Lists Ordered -->
    <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Lists Ordered <small class="text-muted">Default</small></h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            List of items in which the order does explicitly matter. Use <code>&lt;ol type="1|a|A|i|I"&gt;</code>, The
            type attribute specifies the kind of marker to use in the list.
          </p>
          <ol>
            <li>Lorem ipsum dolor sit amet</li>
            <li>Consectetur adipiscing elit</li>
            <li>Integer molestie lorem at massa</li>
            <li>Facilisis in pretium nisl aliquet</li>
            <li>
              Nulla volutpat aliquam velit
              <ol>
                <li>Phasellus iaculis neque</li>
                <li>Purus sodales ultricies</li>
                <li>Vestibulum laoreet porttitor sem</li>
                <li>Ac tristique libero volutpat at</li>
              </ol>
            </li>
            <li>Faucibus porta lacus fringilla vel</li>
            <li>Aenean sit amet erat nunc</li>
            <li>Eget porttitor lorem</li>
          </ol>
        </div>
      </div>
    </div>
    <!--/ Lists Ordered -->
  </div>
  <div class="row match-height">
    <!-- Lists icons -->
    <div class="col-sm-12 col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Lists icons</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            list of terms with icons, use <code>.list-style-icons</code> class. You can use any icon from Vuexy Admin
            icon types.
          </p>
          <ul class="list-style-icons">
            <li><i data-feather="arrow-right"></i> Facilisis in pretium nisl aliquet</li>
            <li>
              <i data-feather="arrow-right"></i> Nulla volutpat aliquam velit
              <ul class="list-style-icons">
                <li><i data-feather="chevron-right"></i> Phasellus iaculis neque</li>
                <li><i data-feather="chevron-right"></i> Ac tristique libero volutpat at</li>
              </ul>
            </li>
            <li><i data-feather="arrow-right"></i> Faucibus porta lacus fringilla vel</li>
            <li><i data-feather="arrow-right"></i> Aenean sit amet erat nunc</li>
          </ul>
        </div>
      </div>
    </div>
    <!--/ Lists icons -->

    <!-- Inline Lists-->
    <div class="col-sm-12 col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Inline Lists <small class="text-muted">Default</small></h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Remove a list’s bullets and apply some light <code>margin</code> with a combination of two classes,
            <code>.list-inline</code> and <code>.list-inline-item</code>.
          </p>
          <p class="card-text">Use inline numbers, alphabet, icons etc... for ordered Inline List.</p>
          <ul class="list-inline">
            <li class="list-inline-item">Chocolate</li>
            <li class="list-inline-item">Cake</li>
            <li class="list-inline-item">Ice-Cream</li>
          </ul>

          <ul class="list-inline">
            <li class="list-inline-item">1. Chocolate</li>
            <li class="list-inline-item">2. Cake</li>
            <li class="list-inline-item">3. Ice-Cream</li>
          </ul>
          <ul class="list-inline">
            <li class="list-inline-item"><i data-feather="dollar-sign"></i>250</li>
            <li class="list-inline-item"><i data-feather="dollar-sign"></i>110</li>
            <li class="list-inline-item"><i data-feather="dollar-sign"></i>890</li>
          </ul>
        </div>
      </div>
    </div>
    <!--/ Inline Lists-->
  </div>
</section>
<!--/ Lists -->

<!-- Description list alignment -->
<section id="description-list-alignment">
  <div class="row">
    <div class="col-md-12 mt-1">
      <div class="group-area">
        <h4>Description list alignment</h4>
        <p>
          Align terms and descriptions horizontally by using our grid system’s predefined classes (or semantic mixins).
          For longer terms, you can optionally add a <code class="highlighter-rouge">.text-truncate</code> class to
          truncate the text with an ellipsis.
        </p>
        <hr />
      </div>
    </div>
  </div>
  <div class="row match-height">
    <!-- Description lists horizontal -->
    <div class="col-sm-12 col-md-8">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Description lists <small class="text-muted">Horizontal</small></h4>
        </div>
        <div class="card-body">
          <dl class="row">
            <dt class="col-sm-3">Description lists</dt>
            <dd class="col-sm-9">A description list is perfect for defining terms.</dd>
          </dl>
          <dl class="row">
            <dt class="col-sm-3">Euismod</dt>
            <dd class="col-sm-9">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
          </dl>
          <dl class="row">
            <dt></dt>
            <dd class="col-sm-9 ms-auto">Donec id elit non mi porta gravida at eget metus.</dd>
          </dl>
          <dl class="row">
            <dt class="col-sm-3">Malesuada porta</dt>
            <dd class="col-sm-9">Etiam porta sem malesuada magna mollis euismod.</dd>
          </dl>
          <dl class="row">
            <dt class="col-sm-3 text-truncate">Truncated term is truncated</dt>
            <dd class="col-sm-9">
              Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet
              risus.
            </dd>
          </dl>
          <dl class="row">
            <dt class="col-sm-3">Nesting</dt>
            <dd class="col-sm-9">
              <dl class="row">
                <dt class="col-sm-4">Nested definition list</dt>
                <dd class="col-sm-8">Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc.</dd>
              </dl>
            </dd>
          </dl>
        </div>
      </div>
    </div>
    <!--/ Description lists horizontal-->

    <!-- Description lists vertical-->
    <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Description lists <small class="text-muted">Vertical</small></h4>
        </div>
        <div class="card-body">
          <dl>
            <dt>Description lists</dt>
            <dd>A description list is perfect for defining terms.</dd>
            <dt>Euismod</dt>
            <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio.</dd>
            <dd>Donec id elit non mi porta gravida at eget metus.</dd>
            <dt>Malesuada porta</dt>
            <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
          </dl>
        </div>
      </div>
    </div>
    <!--/ Description lists vertical-->
  </div>
  <div class="row">
    <!-- Description lists horizontal -->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Description lists <small class="text-muted">Horizontal</small></h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Description lists with right aligned text in <code>&lt;dt&gt;</code> tag using <code>.text-end</code>
          </p>
          <dl class="row">
            <dt class="col-sm-3 text-end">Description lists</dt>
            <dd class="col-sm-9">A description list is perfect for defining terms.</dd>
          </dl>
          <dl class="row">
            <dt class="col-sm-3 text-end">Euismod</dt>
            <dd class="col-sm-9">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
          </dl>
          <dl class="row">
            <dt></dt>
            <dd class="col-sm-9 ms-auto">Donec id elit non mi porta gravida at eget metus.</dd>
          </dl>
          <dl class="row">
            <dt class="col-sm-3 text-end">Malesuada porta</dt>
            <dd class="col-sm-9">Etiam porta sem malesuada magna mollis euismod.</dd>
          </dl>
          <dl class="row">
            <dt class="col-sm-3 text-end text-truncate">Truncated term is truncated</dt>
            <dd class="col-sm-9">
              Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet
              risus.
            </dd>
          </dl>
          <dl class="row">
            <dt class="col-sm-3 text-end">Nesting</dt>
            <dd class="col-sm-9">
              <dl class="row">
                <dt class="col-sm-4">Nested definition list</dt>
                <dd class="col-sm-8">Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc.</dd>
              </dl>
            </dd>
          </dl>
        </div>
      </div>
    </div>
    <!--/ Description lists horizontal-->
  </div>
</section>
<!--/ Description list alignment -->
@endsection
