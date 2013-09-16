ahash
=====

Compute Average Hash (perceptual hash) for image likeness comparison

This is based on the algorithm presented here: http://www.hackerfactor.com/blog/index.php?/archives/432-Looks-Like-It.html

To use:

    $ahash = new Cbulock\Ahash\Ahash('image.jpg');
		echo $ahash->compute();
